<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPrefrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_prefrences', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->boolean('global')->nullable()->default(false);
            $table->integer('ageFrom')->nullable()->default();
            $table->integer('ageTo')->nullable()->default();
            $table->integer('Zipcode')->nullable()->default();
            $table->integer('radius')->nullable()->default();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_prefrences');
    }
}
