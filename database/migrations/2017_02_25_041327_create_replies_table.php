<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('reply_id');
            $table->text('reply');
            $table->integer('forum_id')->unsigned();
            $table->integer('id');
            $table->timestamp('reply_on');
            $table->timestamps();           
          });
            Schema::table('replies', function($table) {
               $table->foreign('forum_id')
                      ->references('forum_id')->on('forums')
                      ->onDelete('cascade');
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
