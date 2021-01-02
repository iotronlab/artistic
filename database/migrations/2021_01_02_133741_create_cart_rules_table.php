<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->default(0);
            $table->string('coupon_code');
            $table->integer('times_used')->unsigned()->default(0);
            $table->string('action_type')->nullable();
            $table->decimal('discount_amount', 12, 4)->default(0);
            $table->integer('max_discount')->nullable();
            $table->string('min_quantity')->default(1);
            $table->boolean('apply_to_shipping')->default(0);
            $table->boolean('free_shipping')->default(0);
            $table->timestamps();
        });

        Schema::create('cart_rule_customer_groups', function (Blueprint $table) {
            $table->bigInteger('cart_rule_id')->unsigned();
            $table->bigInteger('customer_group_id')->unsigned();


            $table->primary(['cart_rule_id', 'customer_group_id']);

            $table->foreign('cart_rule_id')->references('id')->on('cart_rules')->onDelete('cascade');
            $table->foreign('customer_group_id')->references('id')->on('customer_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_rules');
        Schema::dropIfExists('cart_rule_customer_groups');
    }
}
