<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('excerpt')->nullable();
            $table->string('short_link')->nullable();

            // $table->enum('publish_status', [Product::PUBLICADO, Product::BORRADOR, Product::ELIMINADO])->default(Product::BORRADOR);

            $table->enum('status', [Product::PUBLICADO, Product::BORRADOR, Product::ELIMINADO, Product::ARCHIVADO])->default(Product::BORRADOR);

            $table->string('name')->nullable();
            $table->string('slug');
            $table->float('price')->nullable()->default('0.00');
            $table->float('costo')->nullable()->default('0.00');
            $table->float('price_seller')->nullable()->default('0.00');
            $table->integer('quantity')->default(0)->nullable();
            $table->boolean('over_sale')->default(false);
            $table->boolean('force_size_unique')->default(false);

            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');

            // $table->string('name')->default('normal');


            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('users');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->index('name');
            
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
        Schema::dropIfExists('products');
    }
}
