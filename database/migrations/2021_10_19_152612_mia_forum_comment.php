<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MiaForumComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mia_forum_comment', function (Blueprint $table) {
            $table->id();

            $table->integer('forum_id');
    $table->integer('user_id');
    $table->text('comment');
    $table->integer('favorites');
    $table->integer('status');
    

            $table->foreign('forum_id')->references('id')->on('mia_forum');$table->foreign('user_id')->references('id')->on('mia_user');

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
        Schema::dropIfExists('mia_forum_comment');
    }
}