<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CancelUnpaidOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cancel-unpaid-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batalkan pesanan yang belum dibayar (pending) melebihi 1x24 jam dan kembalikan stok produk';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::where('status', 'pending')
            ->where('created_at', '<=', now()->subHours(24))
            ->get();

        $count = 0;

        foreach ($orders as $order) {
            try {
                $reason = 'Dibatalkan otomatis karena tidak melakukan pembayaran dalam 1x24 jam';
                if ($order->cancel($reason)) {
                    $count++;
                }
            } catch (\Exception $e) {
                Log::error("Gagal membatalkan order otomatis (ID: {$order->id}): " . $e->getMessage());
            }
        }

        $this->info("Berhasil membatalkan {$count} pesanan yang belum dibayar dalam 1x24 jam.");
    }
}
