<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinates', function (Blueprint $table) {
            
            //$table->id();
            $table->id();

            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('gps_radio')->nullable();
            $table->string('url_current')->nullable();;
            $table->string('screen')->nullable();;
            $table->string('message')->nullable();
            $table->string('tipo_red')->nullable();;
            $table->string('user_agent')->nullable();;
            $table->string('vendor')->nullable();;

            $table->unsignedBigInteger('coordinateable_id');
            
            $table->string('coordinateable_type');

            // $table->primary(['coordinate_id','coordinateable_type']);

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
        Schema::dropIfExists('coordinates');
    }
}
