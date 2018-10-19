<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('area_name')->unique();
            $table->string('area_code', 3)->unique();
            $table->integer('parentAreaId')->nullable();
            $table->integer('AltId1')->nullable();
            $table->integer('AltId2')->nullable();
            $table->integer('AltId3')->nullable();
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
        Schema::dropIfExists('areas');
    }
}
