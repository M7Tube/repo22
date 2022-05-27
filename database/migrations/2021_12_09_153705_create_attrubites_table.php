<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttrubitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attrubites', function (Blueprint $table) {
            $table->id('attrubite_id');
            $table->string('name');
            $table->json('status');
            $table->boolean('is_required'); // 0 for (No) and 1 for (Yes)
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
        Schema::dropIfExists('attrubites');
    }
}
