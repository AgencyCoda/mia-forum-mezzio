<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaForum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_forum', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
    $table->text('title');
    $table->string('slug');
    $table->text('content');
    $table->integer('favorites');
    $table->integer('comments');
    $table->integer('type');
    $table->integer('item_id');
    

            $table->foreign('item_id')->references('id')->on('book');$table->foreign('user_id')->references('id')->on('mia_user');

            $table->timestamps();

            $table->integer('deleted')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mia_forum');
    }
}