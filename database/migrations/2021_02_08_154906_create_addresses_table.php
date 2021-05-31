<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->index();
            $table->string('name');
            $table->string('contact');
            $table->string('alternate_contact')->nullable();

            $table->enum('type', ['Home', 'Work', 'Other']);
            $table->string('address_1');
            $table->string('address_2')->nullable();

            $table->string('landmark')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->string('state');
            $table->string('country_code');
            $table->boolean('default')->default(false);
            // $table->unsignedBigInteger('country_id');
            $table->foreign('country_code')->references('iso_code_2')->on('countries');
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
