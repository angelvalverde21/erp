<?php

namespace App\Http\Controllers\api\v1\store;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api')->except(['createOneStep']);
    }

    public function index($nickname)
    {
        //

    }

    public function showAll($nickname)
    {
        //
        return response()->json(
            $data = [
                "message" => "se accedio con el token proporcionado ",
            ],
            // $status = 500
            // $status = 200
        );
        
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

    public function createOrder($nickname, Request $request){

        $user = Auth::user();
// $user = request()->user();

// //Si usas una instancia de Request $request
// $user = $request ->user();

        return response()->json(
            $data = [
                "message" => "Create order con login: se accedio con el token proporcionado ",
                "user"=> $user
            ],
            // $status = 500
            // $status = 200
        );
    }

    public function createOneStep($nickname, Request $request)
    {

        //
        //return response()->json(['error' => '200', 'message' => 'Order creada en un solo paso']);
        Log::info($request);

        $store = User::where('nickname', $nickname)->first();
        Log::info($store);

        //Creando un nuevo usuario

        //Creando un nuevo address_id

        //creando un nueva orden

        //retornando el status

        //buyer es el comprador en linea

        try {

            $buyer = new User();

            $buyer->name = trim($request->name); //Elimina los espacios en blanco al incio y final

            $userPhone = User::where('phone',str_replace(' ', '', $request->phone))->first();

            if($userPhone){
                //Telefono ya existe
                return response()->json(
                    $data = [
                        "error" => "500",
                        "msg" => "El telefono ya existe",
                    ],
                    // $status = 500
                    // $status = 200
                );
            }else{
                $buyer->phone = str_replace(' ', '', $request->phone); //Elimina los espacios en blanco de toda la cadena
            }


            $userDni = User::where('dni',$request->dni)->first();

            if ($request->dni) {

                if($userDni){
                    return response()->json(
                        $data = [
                            "error" => "500",
                            "msg" => "El DNI ya existe",
                        ],
                        // $status = 500
                        // $status = 200
                    );
                }else{
                    $buyer->dni = str_replace(' ', '', $request->dni); //Elimina los espacios en blanco de toda la cadena
                }   
            }

            if ($request->password) {
                //el cliente eligio un password
                $buyer->password = bcrypt($request->password); //genera un password con la primera letra de su nombre + un telefono
            } else {
                //generamos un password para el usuario
                $buyer->password = bcrypt(substr(trim($request->name), 0, 1) . $request->phone); //genera un password con la primera letra de su nombre + un telefono
            }

            $buyer->store_id = $store->id; //genera un password con la primera letra de su nombre + un telefono
            $buyer->owner_id = 12; //el usuario 12 es el internet

            $buyer->saveOrFail();
            //una vez creado se asigna el rol de cliente
            $buyer->assignRole('buyer');

            

            //Log::debug($accessToken);
            Log::debug('Usuario creado :' . $buyer);

            try {

                //crear direccion de envio

                $address = new Address();

                $address->name = trim($request->name);
                $request->dni = $buyer->dni;
                $address->phone = $buyer->phone;
                $address->primary = trim($request->primary);
                $address->secondary = trim($request->secondary);
                if ($request->references) {
                    $address->references = trim($request->references);
                }

                $address->user_id = $buyer->id; //el usuario al cual le pertenece la direccion
                $address->district_id  = $request->district_id; //el usuario al cual le pertenece la direccion

                $address->saveOrFail();
                Log::debug('Direccion de envio creado :' . $address);

                //crear id de venta

                try {

                    $order = new Order();

                    $order->delivery_man_id = 3; //el usuario 3 es magaly vanesa
                    $order->payment_list_method_id = 11; //simula que el pago lo hico con transferencia deposito
                    $order->delivery_method_id = 1; //quiere decir que se envia via delivery
                    $order->store_id = $store->id;
                    $order->seller_id = 12; //el usuario 12 es que el pedido vino desde internet
                    $order->buyer_id = $buyer->id;
                    $order->address_id = $address->id; //el id de la direccion recien creada

                    $order->saveOrFail();

                    Log::debug('Orden creado :' . $order);

                    //Hasta aqui todo se creo correctamente

                    //$accessToken = $buyer->createToken('authToken')->accessToken;
                    $accessToken = $buyer->createToken('authToken')->accessToken;

                    if ($buyer->id && $order->id && $address->id) {
                        return response()->json(
                            $data = [
                                "register"=>"success",
                                "id"=> $order->id,
                                "msg" => "se han creado los datos correctamente",
                                "access_token" => $accessToken
                            ],
                            $status = 200
                        );
                    }

                } catch (\Exception $error) {
                    return response()->json(
                        $data = [
                            "error" => "500",
                            "msg" => "Error al crear la orden",
                            "message_api" => $error->getMessage(),
                        ],
                        // $status = 500
                    );
                }
            } catch (\Exception $error) {
                return response()->json(
                    $data = [
                        "error" => "500",
                        "msg" => "Error al crear la direccion de envio",
                        "message_api" => $error->getMessage(),
                    ],
                    // $status = 500
                );
            }
        } catch (\Exception $error) {
            // do task when error
            return response()->json(
                $data = [
                    "error" => "500",
                    "msg" => "Error al crear el usuario",
                    "message_api" => $error->getMessage(),
                ],
                // $status = 500
            );
        }

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
