<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandOversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hand_overs', function (Blueprint $table) {
            $table->id('hand_over_id');
            $table->longText('note');
            $table->string('name');
            $table->string('signture1');
            $table->string('signture1Name');
            $table->string('signture2');
            $table->string('signture2Name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hand_overs');
    }
}
