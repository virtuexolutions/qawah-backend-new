<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSec1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_sec_1', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->string('sub_title', 100)->nullable();
            $table->text('message')->nullable();
            $table->string('cover_img', 100)->nullable();
            $table->string('left_img', 100)->nullable();
            $table->string('right_img', 100)->nullable();
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
        Schema::dropIfExists('home_sec_1');
    }
}
