<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileVerifiedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile_verifieds', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->text('url')->nullable();
            $table->string('image_name', 100)->nullable();
            $table->text('web_url')->nullable();
            $table->text('thumbnail')->nullable();
            $table->boolean('status')->nullable()->comment("0 remove , 1 approved , 2 pending")->default(2);            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_profile_verifieds');
    }
}
