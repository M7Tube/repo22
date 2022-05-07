<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_boxes', function (Blueprint $table) {
            $table->id('box_id');
            $table->string('name');
            $table->bigInteger('template_id')->references('template_id')->on('templates')->onDelete('cascade')->onUpdate('cascade')->index()->unsigned();
            $table->bigInteger('category_id')->references('category_id')->on('report_categories')->onDelete('cascade')->onUpdate('cascade')->index()->unsigned();
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
        Schema::dropIfExists('text_boxes');
    }
}
