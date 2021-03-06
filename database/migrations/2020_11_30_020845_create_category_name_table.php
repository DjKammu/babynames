<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_name', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('name_id');
            $table->foreign('name_id')->references('id')->on('names')->onDelete('cascade');

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
        Schema::dropIfExists('category_name');
    }
}
