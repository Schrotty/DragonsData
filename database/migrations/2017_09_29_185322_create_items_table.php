<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        //Create 'items' table
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('author');
            $table->string('teaser', 50)->nullable();
            $table->integer('category_id')->unsigned();
            $table->timestamps();

            //Index
            $table->index('name', 'item_name');

            //Foreign keys
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
        });

        //Create 'item_access' table
        Schema::create('item_access', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('read_access');
            $table->boolean('write_access');
            $table->timestamps();

            //Foreign key
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('user_id')->references('id')->on('users');
        });

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

        //Create 'item_tags' table
        Schema::create('item_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();

            //Foreign key
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('tag_id')->references('id')->on('tags');
        });

        //Create 'item_properties' table
        Schema::create('item_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->timestamps();

            //Foreign key
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('property_id')->references('id')->on('properties');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
