<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryNomineeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_nominee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nominee_category_id');
            $table->unsignedBigInteger('nominee_id');
            $table->unique(['nominee_id', 'nominee_category_id']);
            $table->foreign('nominee_category_id')->references('id')->on('nominee_categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nominee_id')->references('id')->on('nominees')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_nominee');
    }
}
