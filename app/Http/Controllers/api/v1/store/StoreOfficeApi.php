<?php

namespace App\Http\Controllers\api\v1\store;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StoreOfficeApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nickname)
    {
        //
                //
        // "name": "Aquarella Ropa y Accesorios",
        // "email": "ventas@ara.pe",
        // "nickname": "ara",
        // "dni": null,
        // "ruc": 0,
        // "phone": 16763164,
        // "address_id": null,
        // "email_verified_at": null,
        // "two_factor_confirmed_at": null,
        // "upload_logo_general": "public/users/Bp67zePIDQk27Ue6bcw4dsjMt1STsOcWcsI2RtxV.jpg",
        // "upload_logo_invoice": null,
        // "upload_qr_yape": null,
        // "upload_qr_plin": null,
        // "wallet": null,
        // "contact": null,
        // "owner_id": null,
        // "store_id": null,
        // "current_team_id": null,
        // "profile_photo_path": null,
        // "birthday": null,
        //$store = User::where('nickname',$nickname)->select(['id', 'name', 'email', 'phone', 'upload_logo_general'])->first();
        $store = User::where('nickname',$nickname)->with('addresses')->first();
        return $store->addresses;
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
