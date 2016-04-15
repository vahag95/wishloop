<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRssFeedUrlFieldIntoTrafficGenerationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traffic_generations', function(Blueprint $table)
        {
            $table->string( 'rss_url' )->after('token');                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traffic_generations', function(Blueprint $table)
        {
            $table->dropColumn( 'rss_url' );                        
        });
    }
}
