<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('contact')->nullable();
            $table->enum('gender', ['M', 'F', 'LGBTQ'])->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('subscribed_to_newsletter')->default(false);
            $table->bigInteger('customer_group_id')->unsigned()->nullable();
            $table->foreign('customer_group_id')->references('id')->on('customer_groups')->onDelete('set null');
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
        Schema::dropIfExists('customer_groups');
        Schema::dropIfExists('customers');
    }
}
