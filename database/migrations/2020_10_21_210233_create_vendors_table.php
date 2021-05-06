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
            $table->string('url')->unique();
            $table->string('password');
            $table->string('contact');

            $table->string('avatarimg')->nullable();
            $table->string('coverimg')->nullable();
            $table->text('bio')->nullable();

            //change to meta_keyword json
            $table->json('meta_keyword')->nullable();
            $table->float('rating', 2, 1)->nullable();
            $table->unsignedBigInteger('popularity')->default(10);
            $table->unsignedBigInteger('view_count')->default(10);
            $table->boolean('sponsored')->default(false);
            $table->boolean('is_freelance')->default(false);
            $table->boolean('is_commisioned')->default(false);
            $table->boolean('auto_approve')->default(false);

            $table->boolean('status')->default(true);
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
