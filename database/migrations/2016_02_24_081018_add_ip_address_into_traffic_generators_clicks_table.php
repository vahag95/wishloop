<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIpAddressIntoTrafficGeneratorsClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('traffic_generation_clicks', function (Blueprint $table) {
           $table->string('ip')->after('traffic_id');
       }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traffic_generation_clicks', function (Blueprint $table) {
            $table->dropColumn('ip');
        });
    }
}
