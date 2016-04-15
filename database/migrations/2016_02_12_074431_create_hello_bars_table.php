<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelloBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hello_bars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color');
            $table->string('position');
            $table->string('cta_text');
            $table->string('button_text');
            $table->string('button_color');
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
        Schema::drop('hello_bars');
    }
}
