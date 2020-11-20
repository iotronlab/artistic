<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('position');
            $table->unique(['name']);
        });

        Schema::create('attribute_group_mappings', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('attribute_group_id');
            $table->integer('position')->nullable();
            $table->primary(['attribute_id', 'attribute_group_id']);
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('attribute_group_id')->references('id')->on('attribute_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_group_mappings');

        Schema::dropIfExists('attribute_groups');
    }
}
