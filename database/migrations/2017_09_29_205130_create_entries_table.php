<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('date');
            $table->string('content');
            $table->integer('author_id')->unsigned();
            $table->integer('party_id')->unsigned();
            $table->timestamps();

            //Index
            $table->index('title', 'entry_title');

            //Foreign keys
            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('party_id')->references('id')->on('parties')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
