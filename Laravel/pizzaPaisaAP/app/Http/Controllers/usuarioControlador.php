<?php

namespace App\Http\Controllers;

use App\Models\usuarioModelo;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class usuarioControlador extends Controller
{
    public function index()
    {
        $usuario = usuarioModelo::all();
        if ($usuario->isEmpty()) {
            $data = [
                'message' => 'No hay usuarios registrados',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($usuario, 200);
    }
    public function store(Request $request)
    {
        $validacion = Validator::make(
            $request->all(),
            [
                'UsuarioDocumento' => 'Required|min:2|max:40',
                'UsuarioTelefono' => 'Required|min:2|max:40',
                'Contrasena' => 'Required|min:2|max:100',
                'Correo' => 'Required|email',
                'UsuarioPrimerNombre' => 'Required|min:2|max:40',
                'UsuarioApellido' => 'Required|min:2|max:40',
                'idTipoDocumento' => 'Required|numeric',
                'idTipoUsuario' => 'Required|numeric'
            ]
        );
        if ($validacion->fails()) {
            $data = [
                'message' => 'Hubo un error en la validacion',
                'errors' => $validacion->errors(),
                'status' => 200
            ];
            return response()->json($data, 400);
        }

        $usuario = usuarioModelo::create(
            [
                'UsuarioDocumento' => $request->UsuarioDocumento,
                'UsuarioTelefono' => $request->UsuarioTelefono,
                'Contrasena' => Hash::make($request->Contrasena),
                'Correo' => $request->Correo,
                'UsuarioPrimerNombre' => $request->UsuarioPrimerNombre,
                'UsuarioApellido' => $request->UsuarioApellido,
                'idTipoDocumento' => $request->idTipoDocumento,
                'idTipoUsuario' => $request->idTipoUsuario
            ]
        );
        if (!$usuario) {
            $data = [
                'message' => 'Error al registrar el cliente',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $data = [
            'usuario' => $usuario,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'UsuarioDocumento' => 'required|string',
            'Correo' => 'required|email',
            'Contrasena' => 'required|string',
        ]);


        $usuario = usuarioModelo::where('UsuarioDocumento', $credentials['UsuarioDocumento'])
            ->where('Correo', $credentials['Correo'])
            ->first();

        if ($usuario && Hash::check($credentials['Contrasena'], $usuario->Contrasena)) {
            $token = JWTAuth::fromUser($usuario);
            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'token' => $token,
                'usuario' => $usuario,
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Credenciales incorrectas',
                'status' => 401
            ], 401);
        }
    }
    public function show($UsuarioDocumento)
    {
        $usuario = usuarioModelo::find($UsuarioDocumento);
        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function update(Request $request, $UsuarioDocumento)
    {
        $usuario = usuarioModelo::find($UsuarioDocumento);
        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validacion = Validator::make(
            $request->all(),
            [
                'UsuarioDocumento' => 'Required|min:2|max:40',
                'UsuarioTelefono' => 'Required|min:2|max:40',
                'Contrasena' => 'Required|min:2|max:40',
                'Correo' => 'Required|email',
                'UsuarioPrimerNombre' => 'Required|min:2|max:40',
                'UsuarioApellido' => 'Required|min:2|max:40',
                'idTipoDocumento' => 'Required|numeric',
                'idTipoUsuario' => 'Required|numeric'

            ]
        );
        if ($validacion->fails()) {
            $data = [
                'message' => 'Hubo un error de validacion',
                'errors' => $validacion->errors(),
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $usuario->UsuarioDocumento = $request->UsuarioDocumento;
        $usuario->UsuarioTelefono = $request->UsuarioTelefono;
        $usuario->Contrasena = $request->Contrasena;
        $usuario->Correo = $request->Correo;
        $usuario->UsuarioPrimerNombre = $request->UsuarioPrimerNombre;
        $usuario->UsuarioApellido = $request->UsuarioApellido;
        $usuario->idTipoDocumento = $request->idTipoDocumento;
        $usuario->idTipoUsuario = $request->idTipoUsuario;
        $usuario->save();
        $data = [
            'message' => 'Usuario fue modificado',
            'usuario' => $usuario,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function destroy($UsuarioDocumento)
    {
        $usuario = usuarioModelo::find($UsuarioDocumento);
        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $usuario->delete();
        $data = [
            'message' => 'El usuario fue Eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
