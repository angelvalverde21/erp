<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_stores', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->float('ship_min')->nullable()->default('200.00');

            // $table->unsignedBigInteger('address_id')->nullable();
            // $table->foreign('address_id')->references('id')->on('addresses');

            // $table->string('maps')->nullable();
            $table->string('domain', 2048)->nullable();
            $table->string('instagram', 2048)->nullable();
            $table->string('tiktok', 2048)->nullable();
            $table->string('facebook', 2048)->nullable();
            $table->string('whatsapp', 2048)->nullable();
            $table->string('logo', 2048)->nullable();

            $table->unsignedBigInteger('store_id')->unique();
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('profile_stores');
    }
}
