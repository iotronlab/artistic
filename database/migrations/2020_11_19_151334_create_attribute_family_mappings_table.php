<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeFamilyMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_family_mappings', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_family_id')->index();
            $table->unsignedBigInteger('attribute_group_id')->index();
            $table->foreign('attribute_family_id')->references('id')->on('attribute_families')->onDelete('cascade');
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
        Schema::dropIfExists('attribute_family_mappings');
    }
}
