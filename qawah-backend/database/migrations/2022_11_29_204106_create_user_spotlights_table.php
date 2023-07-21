<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSpotlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_spotlights', function (Blueprint $table) {
            $table->id();
            $table->integer('subsciption_id')->unsigned();
            $table->integer('spotlight')->unsigned();
            $table->dateTime('assign_date')->nullable();
            $table->dateTime('end_date')->nullable();
            // $table->foreign('subsciption_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_spotlights');
    }
}
