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
        Schema::create('prices', function (Blueprint $table) {

            $table->id();

            $table->string('priceable_type');
            $table->unsignedBigInteger('priceable_id');
            $table->string('type')->nullable()->default('normal');
            $table->integer('quantity')->default()->nullable();
            $table->float('value')->nullable()->default('0.0000');

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
        Schema::dropIfExists('prices');
    }
};
