<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view(' auth.login');
})->name('login');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgotpassword');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// PELANGGAN
Route::get('/', function () {
    return view('pelanggan.home.index');
})->name('pelangganhome');

Route::get('/pelanggan/profil', function () {
    return view('pelanggan.profil.index');
})->name('pelangganprofil');

Route::get('/pelanggan/keranjang', function () {
    return view('pelanggan.keranjang.index');
})->name('pelanggankeranjang');

Route::get('/pelanggan/pembelian/detail', function () {
    return view('pelanggan.pembelian.detail');
})->name('pelangganpembeliandetail');

Route::get('/pelanggan/pembelian/riwayat', function () {
    return view('pelanggan.pembelian.riwayat');
})->name('pelangganpembelianriwayat');

Route::get('/pelanggan/produk',function(){
    return view('pelanggan.produk.index');
})->name('pelangganproduk');

Route::get('/pelanggan/produk/detail',function(){
    return view('pelanggan.produk.detail');
})->name('pelangganprodukdetaill');

Route::get('pelanggan/contact',function(){
    return view ('pelanggan.contact');
})->name('pelanggancontact');


// ADMIN
Route::get('/admin/dashboard',function(){
    return view('admin.dashboard.index');
})->name('admindashboard');

Route::get('admin/profil',function(){
    return view('admin.profil.index');
})->name('adminprofil');

Route::get('/admin/produk',function(){
    return view('admin.produk.index');
})->name('adminproduk');

Route::get('/admin/produk/create',function(){
    return view('admin.produk.create');
})->name('adminprodukcreate');

Route::get('/admin/produk/edit',function(){
    return view('admin.produk.edit');
})->name('adminprodukedit');

Route::get('/admin/produk/detail',function(){
    return view ('admin.produk.detail');
})->name('adminprodukdetaill');

Route::get('/admin/pembelian',function(){
    return view('admin.pembelian.index');
})->name('adminpembelianindex');

Route::get('/admin/pembelian/detail',function(){
    return view('admin.pembelian.detail');
})->name('adminpembeliandetail');

Route::get('/admin/akunpelanggan',function(){
    return view('admin.akunpelanggan.index');
})->name('adminakunpelangganindex');

Route::get('/admin/akunpelanggan/edit',function(){
    return view('admin.akunpelanggan.edit');
})->name('adminakunpelangganedit');

Route::get('/admin/kategori',function(){
    return view('admin.kategori.index');
})->name('adminkategoriindex');
Route::get('/admin/kategori/create',function(){
    return view('admin.kategori.create');
})->name('adminkategoricreate');
Route::get('/admin/kategori/edit',function(){
    return view('admin.kategori.edit');
})->name('adminkategoriedit');

Route::get('/admin/merk',function(){
    return view('admin.merk.index');
})->name('adminmerkindex');
Route::get('/admin/merk/create',function(){
    return view('admin.merk.create');
})->name('adminmerkcreate');
Route::get('/admin/merk/edit',function(){
    return view('admin.merk.edit');
})->name('adminmerkedit');