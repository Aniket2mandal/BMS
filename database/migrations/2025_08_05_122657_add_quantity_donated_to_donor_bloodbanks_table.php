<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityDonatedToDonorBloodbanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donor_bloodbanks', function (Blueprint $table) {
            $table->string('quantity_donated')->nullable()->after('bloodbank_id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donor_bloodbanks', function (Blueprint $table) {
            $table->dropColumn('quantity_donated');
        });
    }
}
