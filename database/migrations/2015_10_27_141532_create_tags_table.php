<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        // this is the pivote table
        //this follows a specific naming convention
        //it contains the singular names of the two tables
        //you are connecting so in this case articles and tags
        //become article_tag, this would be useful for a role_user
        //implementation in my CMS
        Schema::create('article_tag', function(Blueprint $table){
            $table->integer('article_id')->unsigned()->index();             //will delete the associated row privote table if article is deleted
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
        Schema::drop('article_tag');
    }
}
