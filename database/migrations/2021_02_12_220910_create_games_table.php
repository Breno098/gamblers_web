<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->nullable();
            $table->time('time')->nullable();
            $table->string('status')->nullable();
            $table->string('stage')->nullable();

            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('team_home_id')->nullable()->constrained('teams');
            $table->foreignId('team_guest_id')->nullable()->constrained('teams');
            $table->foreignId('stadium_id')->nullable()->constrained();
            $table->foreignId('competition_id')->nullable()->constrained();

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
        Schema::dropIfExists('games');
    }
}
