<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('sku')->unique();
            $table->string('type');
            $table->integer('popularity')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('attribute_family_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('view_count')->default(10);
            $table->foreign('attribute_family_id')->references('id')->on('attribute_families')->onDelete('restrict');
        });


        Schema::create('product_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('category_id');
            $table->boolean('base_category')->default(false);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unique(['product_id', 'category_id']);
        });


        Schema::create('product_super_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_super_attributes');

        Schema::dropIfExists('product_categories');

        Schema::dropIfExists('products');
    }
}
