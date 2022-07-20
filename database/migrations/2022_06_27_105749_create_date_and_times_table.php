<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateAndTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_and_times', function (Blueprint $table) {
            $table->id('date_and_time_id');
            $table->string('title');
            $table->date('date');
            $table->boolean('is_required');
            $table->integer('attrubite_value_key');
            $table->bigInteger('template_id')->references('template_id')->on('templates')->onDelete('cascade')->onUpdate('cascade')->index()->unsigned();
            $table->bigInteger('category_id')->references('category_id')->on('report_categories')->onDelete('cascade')->onUpdate('cascade')->index()->unsigned();
            $table->bigInteger('attrubite_id')->references('attrubite_id')->on('attrubites')->onDelete('cascade')->onUpdate('cascade')->index()->unsigned();
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
        Schema::dropIfExists('date_and_times');
    }
}
