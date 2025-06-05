<?php

namespace App\Http\Controllers;

use App\Models\lineaModelo;
use App\Http\Controllers;
use App\Models\SaborModelos;
use App\Models\reservaModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EstadisticasPizzeriaControlador extends Controller
{
    public function topPizzasVendidas()
    {
        // Obtener las pizzas más vendidas
        $topPizzas = DB::table('linea')
        ->join('reserva', 'linea.idPedido', '=', 'reserva.idPedido') // Hacemos un JOIN entre 'linea' y 'reserva'
        ->select('linea.idSabor', DB::raw('SUM(linea.NumeroPorciones) as total_porciones'))
        ->where('reserva.Entregada', 1) // Filtramos por reservas entregadas
        ->groupBy('linea.idSabor')
        ->orderByDesc('total_porciones')
        ->limit(5)
        ->get();

        // Verificar si no hay registros
        if ($topPizzas->isEmpty()) {
            $data = [
                'message' => 'No se encontraron datos de pizzas vendidas.',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Recuperar la información de las pizzas más vendidas con los nombres y precios
        $result = [];
        foreach ($topPizzas as $pizza) {
            $sabor = SaborModelos::where('idSabor', $pizza->idSabor)->first();

            $result[] = [
                'Nombre_Pizza' => $sabor ? $sabor->Nombre_Pizza : 'Desconocida',
                'NumeroPorcionesVendidas' => $pizza->total_porciones,
                'PrecioPorcion' => $sabor ? $sabor->Precio_Porcion : 'Desconocido'
            ];
        }

        // Devolver los resultados en formato JSON
        return response()->json($result, 200);
    }

    public function promedioValorPorOrden()
    {
        $promedio = DB::table('reserva')->avg('PrecioTotal');

        // Quita los ceros innecesarios con rtrim
        $formateado = rtrim(rtrim(number_format($promedio, 2, '.', ''), '0'), '.');
        
        return response()->json([
            'promedio' => $formateado
        ]);
    }

        public function totalPorcionesVendidas()
    {
        
        $totalPorciones = lineaModelo::sum('NumeroPorciones');

        return response()->json([
            'total' => $totalPorciones
        ]);
        
    }

    public function totalDeOrdenes(){
        

        $totalOrdenes = lineaModelo::count('idPedido');
        return response()->json([
            'totalOrdenes'=> $totalOrdenes
        ]);
        
    }

    public function promedioPorcionesPorOrden()
    {
        $totalPorciones = LineaModelo::sum('NumeroPorciones'); // Suma total de porciones pedidas
        $totalOrdenes = reservaModelo::count(); // Total de órdenes registradas

        $promedio = $totalOrdenes > 0 ? $totalPorciones / $totalOrdenes : 0;

        return response()->json([
            'promedioPorcionesPorOrden' => round($promedio, 2) // Redondeado a 2 decimales
        ]);
    }

    public function totalOrdenesPorDia()
    {
        // Obtener el total de órdenes para viernes, sábado y domingo
        $ordenesPorDiaFinDeSemana = reservaModelo::selectRaw(
                'DAYOFWEEK(created_at) as dia_semana, COUNT(*) as total'
            )
            ->whereRaw('DAYOFWEEK(created_at) IN (6, 7, 1)')  // 6 = Viernes, 7 = Sábado, 1 = Domingo
            ->groupByRaw('DAYOFWEEK(created_at)')  // Agrupar por día de la semana
            ->get();
    
        // Inicializamos los totales de los días
        $resultados = [
            'viernes' => 0,
            'sabado' => 0,
            'domingo' => 0
        ];
    
        // Acumulamos las órdenes por cada día
        foreach ($ordenesPorDiaFinDeSemana as $orden) {
            if ($orden->dia_semana == 6) {
                $resultados['viernes'] = $orden->total;
            } elseif ($orden->dia_semana == 7) {
                $resultados['sabado'] = $orden->total;
            } elseif ($orden->dia_semana == 1) {
                $resultados['domingo'] = $orden->total;
            }
        }
    
        // Determinamos cuál día tiene más ventas en general
        $maxVentas = max($resultados['viernes'], $resultados['sabado'], $resultados['domingo']);
        
        // Guardamos el día con más ventas
        if ($maxVentas == $resultados['viernes']) {
            $masVendido = 'Viernes';
        } elseif ($maxVentas == $resultados['sabado']) {
            $masVendido = 'Sábado';
        } else {
            $masVendido = 'Domingo';
        }
    
        return response()->json([
            'resultados' => $resultados,
            'diaMasVendido' => $masVendido
        ]);
    }

    public function totalOrdenesPorMes()
    {
        // Paso 1: Obtener las ventas agrupadas por mes
        $ventasPorMes = reservaModelo::selectRaw('MONTH(created_at) as month, SUM(PrecioTotal) as total')
            ->groupByRaw('MONTH(created_at)')
            ->get()
            ->keyBy('month');
    
        // Paso 2: Generar los 12 meses del año con valores, aunque no existan datos
        $meses = [];
        for ($i = 1; $i <= 12; $i++) {
            $meses[] = [
                'month' => $i,
                'total' => (float) ($ventasPorMes->get($i)->total ?? 0)
            ];
        }
    
        // Paso 3: (opcional) Ordenar de mayor a menor
        usort($meses, fn($a, $b) => $b['total'] <=> $a['total']);
    
        return response()->json([
            'ventasPorMes' => $meses
        ]);
    }

    public function ventasPorSabor()
    {
        $ventasPorSabor = DB::table('linea') // Usa DB::table() para evitar problemas con modelos
            ->join('sabor', 'linea.idSabor', '=', 'sabor.idSabor')
            ->select('sabor.Nombre_Pizza', DB::raw('SUM(linea.NumeroPorciones) as totalPorciones'))
            ->groupBy('sabor.Nombre_Pizza')
            ->orderByDesc('totalPorciones')
            ->get();
    
        return response()->json([
            'ventasPorSabor' => $ventasPorSabor
        ]);
    }

    public function totalIngresos()
{
    $total = DB::table('reserva')
        ->where('Entregada', 1) // solo contar las órdenes entregadas
        ->sum('PrecioTotal');

    return response()->json([
        'totalIngresos' => $total
    ]);
}
}
