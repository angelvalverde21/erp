<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            
            $table->id();

            // $table->unsignedBigInteger('address_id');
            // $table->foreign('address_id')->references('id')->on('addresses');

            $table->string('name');
            $table->text('description');

            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('users');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            
            // $table->unsignedBigInteger('model_id');
            // $table->foreign('model_id')->references('id')->on('users');

            // $table->unsignedBigInteger('address_id');
            // $table->foreign('address_id')->references('id')->on('addresses');

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
        Schema::dropIfExists('albums');
    }
};
