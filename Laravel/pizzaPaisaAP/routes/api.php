<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioControlador;
use App\Http\Controllers\ReservaControlador;
use App\Http\Controllers\LineaControlador;
use App\Http\Controllers\EstadisticasPizzeriaControlador;
use App\Http\Controllers\OrdenIngredienteControlador;
use App\Http\Controllers\OrdenCompraControlador;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [usuarioControlador::class, 'login']);
Route::get('/pizzapaisa', [usuarioControlador::class, 'index']);
Route::post('/pizzapaisa', [usuarioControlador::class, 'store']);
Route::get('/pizzapaisa/{UsuarioDocumento}', [usuarioControlador::class, 'show']);
Route::put('/pizzapaisa/{UsuarioDocumento}', [usuarioControlador::class, 'update']);
Route::delete('/pizzapaisa/{UsuarioDocumento}', [usuarioControlador::class, 'destroy']);

Route::post('/reserva', [ReservaControlador::class, 'store']);
Route::get('/reserva', [ReservaControlador::class, 'index']);
Route::put('/reserva', [ReservaControlador::class, 'updeit']);
Route::delete('/reserva', [ReservaControlador::class, 'dilit']);

Route::get('/linea', [LineaControlador::class, 'index']);
Route::post('/linea', [LineaControlador::class, 'store']);

Route::get('/top-pizzas-vendidas', [EstadisticasPizzeriaControlador::class, 'topPizzasVendidas']);
Route::get('/promedio-valor-orden', [EstadisticasPizzeriaControlador::class, 'promedioValorPorOrden']);
Route::get('/total-porciones-vendidas', [EstadisticasPizzeriaControlador::class, 'totalPorcionesVendidas']);
Route::get('/total-ordenes', [EstadisticasPizzeriaControlador::class, 'totalDeOrdenes']);
Route::get('/promedio-porcion-orden', [EstadisticasPizzeriaControlador::class, 'promedioPorcionesPorOrden']);
Route::get('/total-ordenes-por-dia', [EstadisticasPizzeriaControlador::class, 'totalOrdenesPorDia']);
Route::get('/total-ordenes-por-mes', [EstadisticasPizzeriaControlador::class, 'totalOrdenesPorMes']);
Route::get('/ventas-por-sabor', [EstadisticasPizzeriaControlador::class, 'ventasPorSabor']);
Route::get('/total-ingresos', [EstadisticasPizzeriaControlador::class, 'totalIngresos']);

Route::post('/orden-compra', [OrdenCompraControlador::class, 'store']);
Route::post('/orden-ingrediente', [OrdenIngredienteControlador::class, 'store']);
