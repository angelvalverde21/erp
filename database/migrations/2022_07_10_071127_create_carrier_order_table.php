<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrierOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrier_order', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('carrier_address_id');
            $table->foreign('carrier_address_id')->references('id')->on('addresses');
   
            $table->float('shipping_cost_carrier')->nullable()->default('0.00'); //este es el costo real que cobro el transportista
            $table->float('shipping_cost_buyer')->nullable()->default('0.00'); //este es el costo que se le ha cobrado al cliente
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrier_order');
    }
}
