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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();

            $table->string('thumbnail')->nullable();
            $table->string('medium')->nullable();
            $table->string('large')->nullable();
            $table->string('name')->nullable(); //EJEMPLO DSC3654.JPG
            $table->json('exif')->nullable();
            $table->date('capture_date')->nullable();
            $table->string('photoable_type');
            $table->unsignedBigInteger('photoable_id');
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
        Schema::dropIfExists('photos');
    }
};
