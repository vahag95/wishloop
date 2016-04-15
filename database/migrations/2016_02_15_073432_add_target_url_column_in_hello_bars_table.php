<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTargetUrlColumnInHelloBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hello_bars', function (Blueprint $table) {
            $table->string('target_url')->after('button_color');
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
            $table->dropColumn('target_url');
        });
    }
}
