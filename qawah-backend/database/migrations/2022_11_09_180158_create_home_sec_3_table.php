<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSec3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_sec_3', function (Blueprint $table) {
            $table->id();
            $table->text('title1',250)->nullable();
            $table->text('description1',250)->nullable();
            $table->text('image1',250)->nullable();
            $table->text('title2',250)->nullable();
            $table->text('description2',250)->nullable();
            $table->text('image2',250)->nullable();
            $table->text('title3',250)->nullable();
            $table->text('description3',250)->nullable();
            $table->text('image3',250)->nullable();
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
        Schema::dropIfExists('home_sec_3');
    }
}
