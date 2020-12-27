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

            $table->enum('type', ['Home', 'Work', 'Other'])->nullable();
            $table->string('address_1');
            $table->string('address_2')->nullable();

            $table->string('landmark')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->string('state')->nullable();
            $table->boolean('default')->default(false);
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
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
