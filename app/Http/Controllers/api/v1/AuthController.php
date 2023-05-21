<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api')->except(['login']);
        // $this->middleware('auth:api')->except(['user']);
    }

    public function user()
    {
        $user = Auth::user();

        return response(
            [
                'data' => $user,
                'status' => 200
            ]
        );
    }

    public function login($nickname, Request $request)
    {
        //
        // $validator = Validator($request->all(), [
        //     'email' => 'email|required',
        //     'password' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 404);
        // }

        //Primero validamos los datos
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        //si ha habido errores paralizamos todo con el return, sino seguimos con las siguientes lineas de codigo
        if ($validator->fails()) {
            return response()->json(
                $data = [
                    "message" => 'Los datos no son validos',
                    "message_api" => $validator->errors(),
                    'valid' => false
                ],
                $status = 200
            );
        }

        // $loginData = $request->validate([
        //     'email' => 'email|required',
        //     'password' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(
        //         $data = [

        //             "message" => $validator->errors(),
        //             "error" => true
        //         ],
        //         $status = 200
        //     );
        // }

        //recibimos los datos validados y se lo pasamos a la variable $validated

        //Si responde que la validacion fue correcta, negamos este valor para seguir en el siguiente bloque
        $validated = $validator->validated();

        if (!Auth::attempt($validated)) {
            return response(
                [
                    'message' => 'usuario o contrasena incorrecta',
                    'valid' => false
                ]
            );
        }

        //como todo fue correcto y se paso las validaciones entonces creamos el token, ojo las lineas rojas es una alerta
        //pero todo funciona con normalidad

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        //finalmente enviamos el json al navegador con las respuestas correctas 

        return response()->json(
            $data = [
                "user" => auth()->user(),
                'access_token' => $accessToken,
                'valid' => true
            ],
            $status = 200
        );
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
