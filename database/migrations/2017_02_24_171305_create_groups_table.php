<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('group_id');
            $table->text('group_name');
            $table->timestamps();
            //$table->foreign('group_id')->references('group_id')->on('users');
        });

        DB::table('groups')->insert(array(
            'group_name' => 'Administrator',
        ));

        DB::table('groups')->insert(array(
            'group_name' => 'User',
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
