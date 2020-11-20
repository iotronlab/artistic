<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_flat', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('url_key')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('status')->nullable();
            $table->string('thumbnail')->nullable();

            $table->decimal('price', 12, 4)->nullable();
            $table->decimal('special_price', 12, 4)->nullable();

            $table->text('short_description')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->decimal('width', 12, 4)->nullable();
            $table->decimal('height', 12, 4)->nullable();
            $table->decimal('depth', 12, 4)->nullable();
            $table->decimal('weight', 12, 4)->nullable();

            $table->integer('color')->nullable();
            $table->integer('size')->nullable();
            $table->string('material')->nullable();
            $table->string('medium')->nullable();

            $table->unsignedBigInteger('product_id')->unique();
            $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->boolean('visible_individually')->nullable();

            $table->foreign('parent_id')->references('id')->on('product_flat')->onDelete('cascade');

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
        Schema::dropIfExists('product_flat');
    }
}
