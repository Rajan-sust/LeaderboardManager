<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{

    public function up() {

        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contest_id');
            $table->string('contest_title');
            $table->string('oj');
            $table->integer('problem_num');
            $table->string('problem_name');
            $table->integer('weighted_point');

        });
    }


    public function down() {

        Schema::dropIfExists('problems');
    }
}
