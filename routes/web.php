<?php

use App\Http\Livewire\Estadisticas\ShowEstadisticas;
use App\Http\Livewire\Facturas\ShowFactura;
use App\Http\Livewire\Facturas\ShowPedidos;
use App\Http\Livewire\Productos\ShowProducto;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('productos', ShowProducto::class)->name('productos');
Route::get('nuevafactura', ShowFactura::class)->name('nuevafactura');
Route::get('facturas', ShowPedidos::class)->name('facturas');
Route::get('estadisticas', ShowEstadisticas::class)->name('estadisticas');