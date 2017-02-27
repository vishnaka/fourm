<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('group_id')->default(2);
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(array('name' => "Admin", 'email' => "vishnaka@gmail.com", 'password' => '$2y$10$BQfVbCwzeQzdMa3hPrLWvOJL82mbTVmOgubQxahHL/lP4HoTITYIm', 'group_id' => 1));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
