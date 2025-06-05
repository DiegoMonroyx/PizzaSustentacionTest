<?php

namespace App\Http\Controllers;
use App\Models\reservaModelo;
use App\Models\lineaModelo;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;



class ReservaControlador extends Controller
{

    public function index(){
        $reserva = reservaModelo::all();
        if($reserva->isEmpty()){
            $data=[
                'message' => 'no hay datos',
                'status' => 200
            ];
            return response()->json($data, 404);
        }
        return response()->json($reserva,200);
    }


    public function store(Request $request){
        $validacion = Validator::make($request->all(),
        [
            'FechaHoraEntrega' => 'Required',
            'PrecioTotal'=>'Required|numeric',
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
        $reserva = reservaModelo::create(
            [
                'idPedido'=>reservaModelo::max('idPedido')+1,
                'Entregada'=>0,
                'FechaHoraEntrega' => $request->FechaHoraEntrega,
                'PrecioTotal' => $request->PrecioTotal,
                'UsuarioDocumento' => $request->UsuarioDocumento
            ]
        );

        if(!$reserva){
            $data=[
                'message'=>'Error al registrar reserva',
                'status'=>500
            ];
            return response()->json($data,500);
        }
        $data=[
            'reserva'=>$reserva,
            'status'=>201
        ];
        return response()->json($data,201);
    }

    public function updeit(Request $request){
        $validacion = Validator::make($request->all(),
        [
            'idPedido'=>'Required',
            'Entregada' => 'Required',
        ]);
        if($validacion->fails()){
            $data=[
                'message'=>'Error en la validacion de datos',
                'errors'=>$validacion->errors(),
                'status'=>200
            ];
            return response()->json($data,400);
        }
        $reserva = reservaModelo::where('idPedido', $request->idPedido)->update(
            [
                'idPedido'=>$request->idPedido,
                'Entregada'=>$request->Entregada,
            ]
        );

        if(!$reserva){
            $data=[
                'message'=>'Error al modificar reserva',
                'status'=>500
            ];
            return response()->json($data,500);
        }
        $data=[
            'message' => 'Reserva modificado',
            'usuario'=>$reserva,
            'status'=>201
        ];
        return response()->json($data,201);
    }

    public function dilit(Request $request){
        $validacion = Validator::make($request->all(),
        [ 
            'idPedido' => 'Required'
        ]);
        if($validacion->fails()){
            $data=[
                'message'=>'Error en la validacion de datos',
                'errors'=>$validacion->errors(),
                'status'=>200
            ];
            return response()->json($data,400);
        }
        $linea = lineaModelo::where('idPedido', $request->idPedido)->delete();
        $reserva = reservaModelo::where('idPedido', $request->idPedido)->delete();
        

        if(!$reserva){
            $data=[
                'message'=>'Error al modificar reserva',
                'status'=>500
            ];
            return response()->json($data,500);
        }
        $data=[
            'reserva'=>$reserva,
            'status'=>201
        ];
        return response()->json($data,201);
    }
}