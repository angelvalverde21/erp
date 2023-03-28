<?php

use App\Models\Stock;
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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->integer('barcode')->nullable();
            $table->string('stockable_type');
            $table->unsignedBigInteger('stockable_id');
            $table->enum('status', [Stock::ALMACENADO, Stock::SEPARADO, Stock::VENDIDO, Stock::OBSERVADO])->default(Stock::ALMACENADO);

            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')->references('id')->on('items');

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
        Schema::dropIfExists('stocks');
    }
};
