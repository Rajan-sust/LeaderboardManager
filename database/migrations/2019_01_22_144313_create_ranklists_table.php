<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('ranklists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('contest_id');
            $table->string('solved_mask');
            $table->integer('score');
            $table->integer('penalty');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('ranklists');
    }
}
