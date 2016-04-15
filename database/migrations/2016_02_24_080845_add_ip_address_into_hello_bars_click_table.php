<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIpAddressIntoHelloBarsClickTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('hello_bar_clicks', function (Blueprint $table) {
           $table->string('ip')->after('hello_bar_id');
       }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hello_bar_clicks', function (Blueprint $table) {
            $table->dropColumn('ip');
        });
    }
}
