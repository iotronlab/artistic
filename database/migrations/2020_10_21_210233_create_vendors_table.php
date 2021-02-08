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
            $table->boolean('show_display_name')->default(true);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('vendor_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->unsigned()->index();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('name');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->boolean('default')->default(false);
            $table->timestamps();
            $table->foreign('vendor_id')->references('id')->on('vendors');
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
        Schema::dropIfExists('vendor_addresses');
    }
}
