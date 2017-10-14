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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parties');
    }
}
