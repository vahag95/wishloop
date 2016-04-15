<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_accounts', function(Blueprint $table)
        {
            $table->increments('id');            
            $table->integer('user_id');
            $table->string('access_token');            
            $table->string('access_token_secret');
            $table->bigInteger('tw_user_id');
            $table->string('tw_screen_name');
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
        Schema::drop('twitter_accounts');
    }
}
