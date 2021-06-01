<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->integer('quantity')->unsigned()->default(1);
            $table->bigInteger('courier_id')->unsigned()->nullable();
            $table->string('courier_name')->nullable();
            $table->bigInteger('shipping_rate')->unsigned()->nullable();
            $table->boolean('free_shipping')->nullable();
            $table->integer('etd')->nullable();
            $table->string('etd_date')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('product_id')->references('id')->on('products');
            // $table->foreign('address_id')->references('id')->on('addresses');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_user');
    }
}
