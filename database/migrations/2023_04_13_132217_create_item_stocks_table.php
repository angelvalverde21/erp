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
        Schema::create('item_stock', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
  
            $table->unsignedBigInteger('stock_id')->unique();
            $table->foreign('stock_id')->references('id')->on('stocks');

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
        Schema::dropIfExists('item_stock');
    }
};
