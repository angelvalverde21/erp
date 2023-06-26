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
        Schema::create('tasks', function (Blueprint $table) {
            
            $table->id();

            $table->string('name');

            $table->text('description')->nullable();

            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('users');

            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');

            $table->unsignedBigInteger('assigned_id');
            $table->foreign('assigned_id')->references('id')->on('users');

            $table->string('priority')->default('hight')->nullable();
            $table->unsignedBigInteger('progress')->default('0')->nullable();

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
        Schema::dropIfExists('tasks');
    }
};
