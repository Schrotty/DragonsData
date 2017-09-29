<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('parties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('teaser', 50)->nullable();
            $table->integer('author_id')->unsigned();
            $table->integer('chronist_id')->unsigned();
            $table->timestamps();

            //Index
            $table->index('name', 'party_name');

            //Foreign keys
            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('chronist_id')->references('id')->on('users')->onDelete('restrict');
        });

        //Create 'party_access' table
        Schema::create('party_access', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('party_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('read_access');
            $table->boolean('write_access');

            //Foreign key
            $table->foreign('party_id')->references('id')->on('parties');
            $table->foreign('user_id')->references('id')->on('users');
        });

        //Create 'party_characters' table
        Schema::create('party_characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('party_id')->unsigned();
            $table->integer('item_id')->unsigned();

            //Foreign key
            $table->foreign('party_id')->references('id')->on('party');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parties', function (Blueprint $table) {
            //
        });
    }
}
