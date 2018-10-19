<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('area_id');
            $table->string('league_name');
            $table->string('league_code', 3)->nullable();
            $table->string('emblem_url')->nullable();
            $table->datetime('season_start')->nullable();
            $table->datetime('season_end')->nullable();
            $table->integer('current_matchday')->nullable();
            $table->integer('altId1')->nullable();
            $table->integer('altId2')->nullable();
            $table->integer('altId3')->nullable();            
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
        Schema::dropIfExists('leagues');
    }
}
