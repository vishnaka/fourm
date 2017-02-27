<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('forum_id');
            $table->text('question');
            $table->integer('id');
            $table->timestamp('forum_on');
            $table->timestamps();
            //$table->foreign('id')->references('id')->on('users');
        });
        DB::table('forums')->insert(array('question' => "What is Laraval?", 'id' => "1"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forums');
    }
}
