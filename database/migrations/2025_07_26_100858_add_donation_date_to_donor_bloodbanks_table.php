<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDonationDateToDonorBloodbanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donor_bloodbanks', function (Blueprint $table) {
            $table->date('donation_date')->nullable()->after('bloodbank_id');
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
            $table->dropColumn('donation_date');
        });
    }
}
