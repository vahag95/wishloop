<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmbedCodeColumnInHelloBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hello_bars', function (Blueprint $table) {
            $table->text('embed_code')->after('target_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hello_bars', function (Blueprint $table) {
            $table->dropColumn('embed_code');
        });
    }
}
