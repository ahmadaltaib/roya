<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelUserEpisodesRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_episode_rate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('episode_id')->references('id')->on('show_season_episodes');
            $table->integer('user_id')->references('id')->on('users');
            $table->enum('rate', array('like', 'dislike'));
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
        Schema::dropIfExists('user_episode_rate');
    }
}
