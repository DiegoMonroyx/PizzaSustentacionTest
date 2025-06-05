<?php

namespace App\Http\Controllers;
use App\Models\OrdenIngredienteModelo;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\OrdenCompraModelo;

class OrdenCompraControlador extends Controller
{
    public function store(Request $request){
        $validacion = Validator::make($request->all(),
        [
            'UsuarioDocumento' => 'Required|min:4|max:20',
        ]);
        if($validacion->fails()){
            $data=[
                'message'=>'Error en la validacion de datos',
                'errors'=>$validacion->errors(),
                'status'=>200
            ];
            return response()->json($data,400);
        }
        $ordenCompra = OrdenCompraModelo::create(
            [
                'idOrden'=>OrdenCompraModelo::max('idOrden')+1,
                'UsuarioDocumento' => $request->UsuarioDocumento
            ]
        );

        if(!$ordenCompra){
            $data=[
                'message'=>'Error al registrar orden de compra',
                'status'=>500
            ];
            return response()->json($data,500);
        }
        $data=[
            'Orden de Compra'=>$ordenCompra,
            'status'=>201
        ];
        return response()->json($data,201);
    }
}
