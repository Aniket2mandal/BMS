<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDistrictAndStateToBloodbanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bloodbanks', function (Blueprint $table) {
            $table->string('district')->after('name');
            $table->string('state')->after('district');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bloodbanks', function (Blueprint $table) {
            $table->dropColumn(['district', 'state']);
        });
    }
}
