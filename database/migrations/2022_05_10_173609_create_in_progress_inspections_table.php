<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInProgressInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_progress_inspections', function (Blueprint $table) {
            $table->id('IPI_id');
            $table->string('name');
            $table->string('desc')->nullable();
            $table->string('location');
            $table->date('date');
            $table->json('value')->nullable();
            $table->boolean('is_complated');
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
        Schema::dropIfExists('in_progress_inspections');
    }
}
