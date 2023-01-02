<?php

namespace App\Http\Controllers\api\v1\store;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function verifyPhone($nickname,Request $request)
    {
        //
        Log::info($request);

        $user = User::where('phone',$request->phone)->first();

        if($user){

                $data = [
                    "existe" => true,
                    "msg" => "el telefono ya existe en la base de datos, no puede ser registrado"
                ];

        }else{

                $data = [
                    "existe" => false,
                    "msg" => "el telefono no existe en la base de datos, puede ser registrado"
                ];

        }
        
        return response()->json(
            $data,
            $status = 200
        );

    }

    public function verifyDni($nickname,Request $request)
    {
        //
        Log::info($request);

        $user = User::where('dni',$request->dni)->first();

        if($user){

                $data = [
                    "existe" => true,
                    "msg" => "el DNI ya existe en la base de datos, no puede ser registrado"
                ];

        }else{

                $data = [
                    "existe" => false,
                    "msg" => "el DNI no existe en la base de datos, puede ser registrado"
                ];

        }
        
        return response()->json(
            $data,
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
