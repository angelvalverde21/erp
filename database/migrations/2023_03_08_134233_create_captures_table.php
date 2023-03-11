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
        Schema::create('captures', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('users');  
            
            $table->unsignedBigInteger('production_id');
            $table->foreign('production_id')->references('id')->on('productions');

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
        Schema::dropIfExists('captures');
    }
};
