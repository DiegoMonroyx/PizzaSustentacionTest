<?php

namespace App\Http\Controllers;
use App\Models\reservaModelo;
use App\Models\lineaModelo;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LineaControlador extends Controller
{
    public function index(){
        $linea = lineaModelo::all();
        if($linea->isEmpty()){
            $data=[
                'message' => 'no hay datos',
                'status' => 200
            ];
            return response()->json($data, 404);
        }
        return response()->json($linea,200);
    }

    public function store(Request $request){
        $validacion = Validator::make($request->all(),
        [
            'idSabor' => 'Required',
            'NumeroPorciones'=>'Required|numeric',
        ]);
        if($validacion->fails()){
            $data=[
                'message'=>'Error en la validacion de datos',
                'errors'=>$validacion->errors(),
                'status'=>200
            ];
            return response()->json($data,400);
        }
        $linea = lineaModelo::create(
            [
                'idPedido'=>reservaModelo::max('idPedido'),
                'idSabor' => $request->idSabor,
                'NumeroPorciones' => $request->NumeroPorciones,
            ]
        );

        if(!$linea){
            $data=[
                'message'=>'Error al registrar linea',
                'status'=>500
            ];
            return response()->json($data,500);
        }
        $data=[
            'linea'=>$linea,
            'status'=>201
        ];
        return response()->json($data,201);
    }
}
