<?php

namespace App\Http\Controllers;

use App\Models\OrdenCompraModelo;
use App\Models\OrdenIngredienteModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdenIngredienteControlador extends Controller
{
    public function store(Request $request)
    {
        // Validar entrada
        $validacion = Validator::make($request->all(), [
            'idOrden' => 'required|numeric|exists:ordendecompra,idOrden',
            'items' => 'required|array|min:1',
            'items.*.idIngrediente' => 'required|string',
            'items.*.CantidadComprada' => 'required|numeric'
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validacion->errors(),
                'status' => 400
            ], 400);
        }

        $ordenes = [];
        $idOrden = $request->idOrden; // ✅ Usar el idOrden que viene del frontend

        foreach ($request->items as $item) {
            $ordenIngrediente = OrdenIngredienteModelo::create([
                'idOrden' => $idOrden,
                'idIngrediente' => $item['idIngrediente'],
                'CantidadSolicitada' => 0,
                'idProveedor' => 1,
                'CantidadComprada' => $item['CantidadComprada'],
            ]);

            $ordenes[] = $ordenIngrediente;
        }

        return response()->json([
            'Orden Ingrediente' => $ordenes,
            'status' => 201
        ], 201);
    }
}
