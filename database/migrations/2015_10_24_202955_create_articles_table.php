<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            //unsigned makes sure the int assigned is positive
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
            $table->timestamp('published_at');
            //this is how to assign a foreign key
            $table->foreign('user_id')//<-the key from this table
                  ->references('id')//<-the key from the linked to table
                  ->on('users')//<-the name of the linked to table
                  ->onDelete('cascade');//<-when the user is deleted delete
                                        //their associated records
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
