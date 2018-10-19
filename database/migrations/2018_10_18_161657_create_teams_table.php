<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('area_id');
            $table->string('team_name');
            $table->string('short_name')->nullable();
            $table->string('tla', 3)->nullable();
            $table->string('crest_url')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->integer('founded')->nullable();
            $table->string('club_colours')->nullable();
            $table->string('venue')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
