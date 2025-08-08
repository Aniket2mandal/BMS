<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodBloodbanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_bloodbanks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blood_id')->constrained('bloods')->onDelete('cascade');
            $table->foreignId('bloodbank_id')->constrained('bloodbanks')->onDelete('cascade');
            $table->integer('quantity')->default(0); // Optional: Track blood quantity
            $table->timestamps();

            $table->unique(['blood_id', 'bloodbank_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_bloodbanks');
    }
}
