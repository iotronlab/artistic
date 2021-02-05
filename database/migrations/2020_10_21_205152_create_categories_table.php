<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('restrict');
            $table->string('meta_title')->nullable();
            $table->json('meta_keyword')->nullable();
            $table->text('meta_desc')->nullable();
            $table->string('name');
            $table->string('image_path')->nullable();
            $table->string('url')->unique();
            $table->boolean('status')->default(true);
            $table->boolean('is_visible_on_front')->default(true);
            $table->unsignedBigInteger('view_count')->default(10);
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
        Schema::dropIfExists('categories');
    }
}
