<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    private const DEFAULT_WEEK_COUNT = 12;
    private const DEFAULT_YEAR_COUNT = 5;
    private const STATUS_REVENUE = 'delivered';

    public function index(Request $request): View
    {
        $weeks = $this->clamp((int) $request->query('weeks', self::DEFAULT_WEEK_COUNT), 4, 52);
        $years = $this->clamp((int) $request->query('years', self::DEFAULT_YEAR_COUNT), 3, 10);
        $year = (int) $request->query('year', Carbon::now()->year);

        if ($year < 2000 || $year > Carbon::now()->year + 1) {
            $year = Carbon::now()->year;
        }

        $weekly = $this->buildWeeklyData($weeks);
        $monthly = $this->buildMonthlyData($year);
        $yearly = $this->buildYearlyData($years);

        $summary = [
            'week' => $this->sumInRange(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()),
            'month' => $this->sumInRange(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()),
            'year' => $this->sumInRange(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),
        ];

        return view('owner.reports.index', [
            'weekly' => $weekly,
            'monthly' => $monthly,
            'yearly' => $yearly,
            'summary' => $summary,
            'filters' => [
                'weeks' => $weeks,
                'year' => $year,
                'years' => $years,
            ],
        ]);
    }

    public function export(Request $request)
    {
        $type = $request->query('type', 'weekly');
        $format = $request->query('format', 'csv');

        if (!in_array($type, ['weekly', 'monthly', 'yearly'], true)) {
            abort(404);
        }

        if (!in_array($format, ['csv', 'pdf'], true)) {
            abort(404);
        }

        $data = $this->getExportData($type, $request);

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('owner.reports.pdf', [
                'title' => $data['title'],
                'rows' => $data['rows'],
                'total' => $data['total'],
                'generatedAt' => Carbon::now(),
            ])->setPaper('a4', 'portrait');

            return $pdf->download($data['filename'] . '.pdf');
        }

        return $this->downloadCsv($data['filename'] . '.csv', $data['title'], $data['rows'], $data['total']);
    }

    private function baseQuery()
    {
        return Order::query()->where('status', self::STATUS_REVENUE);
    }

    private function sumInRange(Carbon $start, Carbon $end): float
    {
        return (float) $this->baseQuery()
            ->whereBetween('created_at', [$start, $end])
            ->sum('total');
    }

    private function buildWeeklyData(int $weeks): array
    {
        $end = Carbon::now()->endOfWeek();
        $start = (clone $end)->subWeeks($weeks - 1)->startOfWeek();

        $orders = $this->baseQuery()
            ->whereBetween('created_at', [$start, $end])
            ->get(['created_at', 'total']);

        $totalsByWeek = [];
        foreach ($orders as $order) {
            $weekStart = Carbon::parse($order->created_at)->startOfWeek()->format('Y-m-d');
            $totalsByWeek[$weekStart] = ($totalsByWeek[$weekStart] ?? 0) + (float) $order->total;
        }

        $labels = [];
        $totals = [];
        $rows = [];

        $cursor = $start->copy();
        while ($cursor->lessThanOrEqualTo($end)) {
            $weekStart = $cursor->copy();
            $weekEnd = $cursor->copy()->endOfWeek();
            $key = $weekStart->format('Y-m-d');
            $total = round($totalsByWeek[$key] ?? 0, 2);
            $label = $weekStart->format('d M') . ' - ' . $weekEnd->format('d M');

            $labels[] = $label;
            $totals[] = $total;
            $rows[] = [
                'label' => $label,
                'start' => $weekStart->toDateString(),
                'end' => $weekEnd->toDateString(),
                'total' => $total,
            ];

            $cursor->addWeek();
        }

        return [
            'labels' => $labels,
            'totals' => $totals,
            'rows' => $rows,
            'total' => array_sum($totals),
            'range' => $start->toDateString() . ' - ' . $end->toDateString(),
        ];
    }

    private function buildMonthlyData(int $year): array
    {
        $start = Carbon::create($year, 1, 1)->startOfDay();
        $end = Carbon::create($year, 12, 31)->endOfDay();

        $orders = $this->baseQuery()
            ->whereBetween('created_at', [$start, $end])
            ->get(['created_at', 'total']);

        $totalsByMonth = [];
        foreach ($orders as $order) {
            $month = (int) Carbon::parse($order->created_at)->format('n');
            $totalsByMonth[$month] = ($totalsByMonth[$month] ?? 0) + (float) $order->total;
        }

        $labels = [];
        $totals = [];
        $rows = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthDate = Carbon::create($year, $month, 1);
            $label = $monthDate->format('M Y');
            $total = round($totalsByMonth[$month] ?? 0, 2);

            $labels[] = $monthDate->format('M');
            $totals[] = $total;
            $rows[] = [
                'label' => $label,
                'start' => $monthDate->copy()->startOfMonth()->toDateString(),
                'end' => $monthDate->copy()->endOfMonth()->toDateString(),
                'total' => $total,
            ];
        }

        return [
            'labels' => $labels,
            'totals' => $totals,
            'rows' => $rows,
            'total' => array_sum($totals),
            'year' => $year,
        ];
    }

    private function buildYearlyData(int $years): array
    {
        $currentYear = Carbon::now()->year;
        $startYear = $currentYear - ($years - 1);
        $start = Carbon::create($startYear, 1, 1)->startOfDay();
        $end = Carbon::create($currentYear, 12, 31)->endOfDay();

        $orders = $this->baseQuery()
            ->whereBetween('created_at', [$start, $end])
            ->get(['created_at', 'total']);

        $totalsByYear = [];
        foreach ($orders as $order) {
            $year = (int) Carbon::parse($order->created_at)->format('Y');
            $totalsByYear[$year] = ($totalsByYear[$year] ?? 0) + (float) $order->total;
        }

        $labels = [];
        $totals = [];
        $rows = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $total = round($totalsByYear[$year] ?? 0, 2);

            $labels[] = (string) $year;
            $totals[] = $total;
            $rows[] = [
                'label' => (string) $year,
                'start' => Carbon::create($year, 1, 1)->toDateString(),
                'end' => Carbon::create($year, 12, 31)->toDateString(),
                'total' => $total,
            ];
        }

        return [
            'labels' => $labels,
            'totals' => $totals,
            'rows' => $rows,
            'total' => array_sum($totals),
            'range' => $startYear . ' - ' . $currentYear,
        ];
    }

    private function downloadCsv(string $filename, string $title, array $rows, float $total): StreamedResponse
    {
        return response()->streamDownload(function () use ($title, $rows, $total) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [$title]);
            fputcsv($handle, ['Periode', 'Total (Rp)']);

            foreach ($rows as $row) {
                fputcsv($handle, [$row['label'], number_format((float) $row['total'], 2, '.', '')]);
            }

            fputcsv($handle, ['Total', number_format($total, 2, '.', '')]);
            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    private function getExportData(string $type, Request $request): array
    {
        if ($type === 'weekly') {
            $weeks = $this->clamp((int) $request->query('weeks', self::DEFAULT_WEEK_COUNT), 4, 52);
            $data = $this->buildWeeklyData($weeks);

            return [
                'title' => 'Laporan Pendapatan Mingguan',
                'rows' => $data['rows'],
                'total' => $data['total'],
                'filename' => 'laporan-pendapatan-mingguan',
            ];
        }

        if ($type === 'monthly') {
            $year = (int) $request->query('year', Carbon::now()->year);
            $data = $this->buildMonthlyData($year);

            return [
                'title' => 'Laporan Pendapatan Bulanan - ' . $data['year'],
                'rows' => $data['rows'],
                'total' => $data['total'],
                'filename' => 'laporan-pendapatan-bulanan-' . $data['year'],
            ];
        }

        $years = $this->clamp((int) $request->query('years', self::DEFAULT_YEAR_COUNT), 3, 10);
        $data = $this->buildYearlyData($years);

        return [
            'title' => 'Laporan Pendapatan Tahunan',
            'rows' => $data['rows'],
            'total' => $data['total'],
            'filename' => 'laporan-pendapatan-tahunan',
        ];
    }

    private function clamp(int $value, int $min, int $max): int
    {
        if ($value < $min) {
            return $min;
        }

        if ($value > $max) {
            return $max;
        }

        return $value;
    }
}
