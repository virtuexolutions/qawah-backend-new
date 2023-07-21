<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSec4Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_sec_4', function (Blueprint $table) {
            $table->id();

            $table->string('title',250)->nullable();
            $table->text('iframe')->nullable();
            $table->text('title1')->nullable();
            $table->text('description1')->nullable();
            $table->text('title2')->nullable();
            $table->text('description2')->nullable();
            $table->text('title3')->nullable();
            $table->text('description3')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('home_sec_4');
    }
}
