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
        Schema::create('locations', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('primary');
            $table->string('secondary')->nullable();
            $table->string('references')->nullable();
            $table->string('coordenadas')->nullable();
            $table->string('maps')->nullable();

            $table->unsignedInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');

            $table->string('locationable_type');
            $table->unsignedBigInteger('locationable_id');

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
        Schema::dropIfExists('locations');
    }
};
