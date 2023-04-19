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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('nickname')->unique()->nullable();
            $table->unsignedBigInteger('dni')->unique()->nullable();
            $table->unsignedBigInteger('ruc')->unique()->nullable();
            $table->unsignedBigInteger('phone')->unique()->nullable();

            // $table->unsignedBigInteger('address_id')->nullable();
            // $table->foreign('address_id')->references('id')->on('addresses');
            // $table->unsignedBigInteger('yape')->nullable();
            // $table->unsignedBigInteger('plin')->nullable();
            // $table->unsignedBigInteger('whatsapp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('logo', 2048)->nullable();
            $table->string('logo_invoice', 2048)->nullable();
            $table->string('qr_yape', 2048)->nullable();
            $table->string('qr_plin', 2048)->nullable();
            $table->json('wallet')->nullable();//ojo cuando se crea este campo tipo json se necesita un traductor en el modelo user, aqui iran 6 campos y todos siempre debe estar presentes en un solo card
            $table->json('contact')->nullable();//ojo cuando se crea este campo tipo json se necesita un traductor en el modelo user
            $table->rememberToken();
            $table->foreignId('owner_id')->nullable(); // indica que su propietario es el usuario con id owner_id
            $table->foreignId('store_id')->nullable(); // indica que este usuario pertenece a la tienda con id store_id
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('birthday')->nullable();
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
        Schema::dropIfExists('users');
    }
};
