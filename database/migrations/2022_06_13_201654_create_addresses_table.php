<?php

use App\Models\Address;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {

            $table->id();
            $table->string('title')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('dni')->nullable();
            $table->unsignedBigInteger('phone')->nullable();
            $table->string('primary')->nullable();
            $table->string('secondary')->nullable();
            $table->string('references')->nullable();
            $table->string('coordenadas')->nullable();
            $table->string('maps')->nullable();

            $table->enum('status', [Address::PUBLICADO, Address::BORRADO])->default(Address::PUBLICADO);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            
            $table->string('addressable_type')->default('App\/Models\/User');
            $table->unsignedBigInteger('addressable_id')->default(1);
            
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
        Schema::dropIfExists('addresses');
    }
}
