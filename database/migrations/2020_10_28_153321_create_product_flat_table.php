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
            $table->string('name')->nullable();

            $table->string('url_key')->nullable();
            $table->boolean('featured')->nullable();



            $table->integer('price')->nullable();
            $table->integer('special_price')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('meta_title')->nullable();
            $table->json('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();

            $table->decimal('width', 12, 2)->nullable();
            $table->decimal('height', 12, 2)->nullable();
            $table->decimal('length', 12, 2)->nullable();
            $table->decimal('weight', 12, 2)->nullable();

            $table->integer('color')->nullable();
            $table->integer('size')->nullable();
            $table->integer('material')->nullable();
            $table->integer('medium')->nullable();
            $table->integer('orientation')->nullable();

            $table->unsignedBigInteger('product_id')->unique();
            $table->unsignedBigInteger('parent_id')->unsigned()->nullable();
            $table->boolean('visible_individually')->nullable();
            $table->unsignedBigInteger('tax_category_id')->nullable();

            $table->foreign('tax_category_id')->references('id')->on('tax_categories');
            $table->foreign('parent_id')->references('id')->on('product_flat')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
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
