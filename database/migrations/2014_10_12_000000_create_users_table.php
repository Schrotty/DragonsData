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
        //Create the users schema
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('auth');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        //Create Root user
        $flight = App\User::create([
            'username'  => 'Root',
            'auth'      =>  '0',
            'password'  =>  \Illuminate\Support\Facades\Hash::make('RomeoTango')
        ]);
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
