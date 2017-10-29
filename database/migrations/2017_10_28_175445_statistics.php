<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Statistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class');
            $table->integer('victoryTeam');
            $table->string('team1Surrender');
            $table->string('team2Surrender');
            $table->string('timeTeam1');
            $table->string('timeTeam2');
            $table->string('didTimeRunOut');
            $table->string('didTeam1Finish');
            $table->string('didTeam2Finish');
            $table->string('formulaTeam1');
            $table->string('formulaTeam2');
            $table->string('resultTeam1');
            $table->string('resultTeam2');
            $table->string('enteredResultTeam1')->nullable();
            $table->string('enteredResultTeam2')->nullable();
            $table->integer('attemptsTeam1');
            $table->integer('attemptsTeam2');
            $table->integer('timeRanOutForTeam');
            $table->string('team1Tried');
            $table->string('team2Tried');
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
        Schema::dropIfExists('statistics');
    }
}
