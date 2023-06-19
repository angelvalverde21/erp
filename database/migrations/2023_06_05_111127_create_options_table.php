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
        Schema::create('options', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('value');
            $table->string('group'); // ejemplo "redes" y los valores serian { name: instagram, value: 'aquarella'}

            $table->string('optionable_type');
            $table->unsignedBigInteger('optionable_id');

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
        Schema::dropIfExists('options');
    }
};
