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


            $table->string('name', 100);
            $table->string('image_path', 400)->nullable();
            $table->string('url', 100)->unique();
            $table->string('meta_title', 100)->nullable();
            $table->json('meta_keyword', 200)->nullable();
            $table->text('meta_desc', 600)->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_visible_on_front')->default(true);
            $table->unsignedBigInteger('view_count')->default(10);
            $table->unsignedInteger('order')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('restrict');
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
