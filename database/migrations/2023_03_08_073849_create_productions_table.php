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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->text('content')->nullable();
            $table->string('excerpt')->nullable();
            $table->string('slug')->nullable();
            $table->string('short_link')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('users');
            // $table->string('name')->default('normal');
            $table->float('amount')->nullable()->default('0.00');

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
        Schema::dropIfExists('productions');
    }
};
