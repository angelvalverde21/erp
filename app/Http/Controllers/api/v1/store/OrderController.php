<?php

namespace App\Http\Controllers\api\v1\store;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\ColorSize;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
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
        //show All

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nickname, $id)
    {
        //
        $store = User::where('nickname', $nickname)->first();

        //User $store llama a la variable $nickname que viene en las rutas

        $order = Order::where('id', $id)
            ->with('address')
            ->with('items')->first();

        //despues de llamar a la coleccion le aplicamos las restricciones

        /*********** este es un ejemplo  *********/
        // $users = User::query()
        //     ->join('location', 'users.id', '=', 'location.id')
        //     ->join('user_technical_details', 'users.id', '=', 'user_technical_details.id')
        //     ->get();
        // foreach ($users as $user) {
        //     $user->makeHidden(['password', 'OTP']);
        // }
        /****************************************/

        $order = $order->makeHidden(['observations_private', 'shipping_cost_to_carrier', 'shipping_cost_carrier']);

        Log::info($order);

        $user = Auth::user();

        // $order = Order::where('id',$id)->where('buyer_id',$user->id)->where('store_id',$store->id)->first();

        if ($order) {
            return response()->json(
                $data = [
                    "message" => "se accedio con el token proporcionado ",
                    "order" => $order
                    // "order" => $order->makeHidden(['observations_private','shipping_cost_to_carrier'])
                    //             ->with('address')->first()
                    //Ojo para que funcione la inclusion colocar first() ya que la instancia solo trae una coleccion sino no funcionara
                ],
                // $status = 500
                // $status = 200
            );
        } else {
            return response()->json(
                $data = [
                    "message" => "Ha ocurrido un error al seleccionar la orden",
                    "error" => 1,
                    "order_id" => $order->id,
                    "buyer_id" => $user->id,
                    "store_id" => $store->id
                ],
                // $status = 500
                // $status = 200
            );
        }
    }

    public function showAll($nickname)
    {
        //

        $user = Auth::user();

        return response()->json(
            $data = [
                "message" => "se accedio con el token proporcionado ",
                "orders" => $user->myOrders
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

    public function createOrder($nickname, Request $request)
    {

        $user = Auth::user();
        // $user = request()->user();

        // //Si usas una instancia de Request $request
        // $user = $request ->user();

        return response()->json(
            $data = [
                "message" => "Create order con login: se accedio con el token proporcionado ",
                "user" => $user
            ],
            // $status = 500
            // $status = 200
        );
    }

    //Registrar sin login

    public function createOrderWithLogin($nickname, Request $request){

        $buyer = Auth::user();

        $store = User::where('nickname', $nickname)->first();

        if($buyer){

            try {

                $order = new Order();

                $order->delivery_man_id = 1707; //el usuario 1707 es magaly vanesa
                $order->shipping_cost_buyer = 0; //por el momento todos los pedidos de internet tienen envio gratis
                $order->payment_method_id = 1; //simula que el pago lo hico con transferencia deposito
                $order->delivery_method_id = 1; //quiere decir que se envia via delivery
                $order->store_id = $store->id;
                $order->seller_id = 1; //el usuario 1 es que el pedido vino desde internet
                $order->buyer_id = $buyer->id;
                $order->address_id = $buyer->addresses->first()->id; //el id de la direccion recien creada

                $order->saveOrFail();

                Log::debug('Orden creado :' . $order);

                //Ahora Agregar los items del carrito de compras a la orden

                createItemsOrder($request->order, $order->id);

                //Hasta aqui todo se creo correctamente

                //$accessToken = $buyer->createToken('authToken')->accessToken;


                if ($order->id) {
                    return response()->json(
                        $data = [
                            "register" => "success",
                            "id" => $order->id,
                            "msg" => "se han creado la orden correctamente",
                        ],
                        $status = 200
                    );
                }

            } catch (\Exception $error) {

                Log::info($error->getMessage());

                return response()->json(
                    $data = [
                        "error" => "500",
                        "msg" => "Error al crear la orden",
                        "message_api" => $error->getMessage(),
                    ],

                    
                    // $status = 500
                );
            }

        }else{
            return response()->json(
                $data = [
                    "message" => "el usuario no esta autenticado"
                ],
                // $status = 500
                // $status = 200
            );
        }

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

            $userPhone = User::where('phone', str_replace(' ', '', $request->phone))->first();

            if ($userPhone) {
                //Telefono ya existe
                return response()->json(
                    $data = [
                        "error" => "500",
                        "msg" => "El telefono ya existe",
                    ],
                    // $status = 500
                    // $status = 200
                );
            } else {
                $buyer->phone = str_replace(' ', '', $request->phone); //Elimina los espacios en blanco de toda la cadena
            }

            $userDni = User::where('dni', $request->dni)->first();

            if ($request->dni) {

                if ($userDni) {
                    return response()->json(
                        $data = [
                            "error" => "500",
                            "msg" => "El DNI ya existe",
                        ],
                        // $status = 500
                        // $status = 200
                    );
                } else {
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

                    $order->delivery_man_id = 1707; //el usuario 1707 es magaly vanesa
                    $order->shipping_cost_buyer = 0; //por el momento todos los pedidos de internet tienen envio gratis
                    $order->payment_method_id = 1; //simula que el pago lo hico con transferencia deposito
                    $order->delivery_method_id = 1; //quiere decir que se envia via delivery
                    $order->store_id = $store->id;
                    $order->seller_id = 1; //el usuario 1 es que el pedido vino desde internet
                    $order->buyer_id = $buyer->id;
                    $order->address_id = $address->id; //el id de la direccion recien creada

                    $order->saveOrFail();

                    Log::debug('Orden creado :' . $order);

                    //Ahora Agregar los items del carrito de compras a la orden

                    createItemsOrder($request->order, $order->id);

                    //Hasta aqui todo se creo correctamente

                    //$accessToken = $buyer->createToken('authToken')->accessToken;
                    $accessToken = $buyer->createToken('authToken')->accessToken;

                    if ($buyer->id && $order->id && $address->id) {
                        return response()->json(
                            $data = [
                                "register" => "success",
                                "user" => $order->buyer,
                                "roles" => $order->buyer->roles,
                                "id" => $order->id,
                                "msg" => "se han creado los datos correctamente",
                                "access_token" => $accessToken
                            ],
                            $status = 200
                        );
                    }
                } catch (\Exception $error) {

                    Log::info($error->getMessage());

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
