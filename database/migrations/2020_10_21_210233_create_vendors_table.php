<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('contact_name');
            $table->string('email')->unique();
            $table->string('slug')->unique();

            $table->string('password');
            $table->string('contact')->nullable();

            $table->string('avatarimg')->nullable();
            $table->string('coverimg')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            //change to meta_keyword json
            $table->text('meta_desc')->nullable();
            $table->float('rating', 2, 1)->nullable();
            $table->unsignedBigInteger('popularity')->nullable();
            $table->unsignedBigInteger('view_count')->nullable();
            $table->boolean('sponsored')->default('0');
            $table->boolean('is_freelance')->default('0');
            $table->boolean('is_commisioned')->default('0');
            $table->boolean('auto_approve')->default('0');
            $table->boolean('show_display_name')->default('0');
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('vendors');
    }
}
