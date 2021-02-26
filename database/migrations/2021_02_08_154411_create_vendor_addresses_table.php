<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->unsigned()->index();
            $table->string('name');
            $table->string('contact');

            $table->enum('type', ['Home', 'Work', 'Other']);
            $table->string('address_1');
            $table->string('address_2')->nullable();

            $table->string('landmark')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->string('state');
            $table->boolean('default')->default(false);
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
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
        Schema::dropIfExists('vendor_addresses');
    }
}
