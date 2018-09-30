<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelShowSeasonsEpisodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_season_episodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('season_id')->references('id')->on('show_seasons');
            $table->string('title');
            $table->text('description');
            $table->string('show_time');
            $table->string('thumbnail');
            $table->string('video');
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
        Schema::dropIfExists('show_season_episodes');
    }
}
