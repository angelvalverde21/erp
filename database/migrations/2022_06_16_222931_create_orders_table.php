<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('users');

            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id')->references('id')->on('users');

            
            $table->unsignedBigInteger('store_id')->default('10');
            $table->foreign('store_id')->references('id')->on('users');

            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');

            $table->unsignedBigInteger('payment_method_id')->default(1);
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');

            $table->unsignedBigInteger('delivery_method_id')->default(1);
            $table->foreign('delivery_method_id')->references('id')->on('delivery_methods');

            $table->unsignedBigInteger('collect_method_id')->default(2);
            $table->foreign('collect_method_id')->references('id')->on('collect_methods');

            $table->unsignedBigInteger('delivery_man_id')->default('3'); //. es Magaly vanesa
            $table->foreign('delivery_man_id')->references('id')->on('users');  

            $table->unsignedBigInteger('carrier_address_id')->default('4'); //4 es olva courier
            $table->foreign('carrier_address_id')->references('id')->on('addresses'); 

            $table->float('shipping_cost_to_carrier')->nullable()->default('0.00'); //este es el costo real que cobro el transportista
            $table->float('shipping_cost_carrier')->nullable()->default('0.00'); //este es el costo real que cobro el transportista
            $table->float('shipping_cost_buyer')->nullable()->default('0.00'); //este es el costo que se le ha cobrado al cliente

            $table->date('delivery_date')->default(date("Y-m-d"))->nullable();
            $table->time('delivery_time_start')->default('10:00')->nullable();
            $table->time('delivery_time_end')->default('20:00')->nullable();

            // $table->string('data_payment')->json()->nullable();
            $table->string('photo_payment')->nullable();
            $table->string('photo_package')->nullable();
            $table->string('photo_delivery')->nullable();

            $table->boolean('is_active')->default(1);

            //$table->float('total')->nullable()->default('0');
            $table->text('observations_time')->nullable();
            $table->text('observations_public')->nullable();
            $table->text('observations_private')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
