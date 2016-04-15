<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmbedCodeColumnInTrafficGenerationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traffic_generations', function (Blueprint $table) {
            $table->text('embed_code')->after('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traffic_generations', function (Blueprint $table) {
            $table->dropColumn('embed_code');
        });
    }
}
