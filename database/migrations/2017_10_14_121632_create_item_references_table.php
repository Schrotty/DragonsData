<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        //Create 'item_references' table
        Schema::create('item_references', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('source_item_id')->unsigned();
            $table->integer('target_item_id')->unsigned();
            $table->timestamps();

            //Foreign key
            $table->foreign('source_item_id')->references('id')->on('items');
            $table->foreign('target_item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_references');
    }
}
