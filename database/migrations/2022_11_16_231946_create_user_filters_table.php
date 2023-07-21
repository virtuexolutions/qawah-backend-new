<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_filters', function (Blueprint $table) {
            $table->id();
            $table->integer('filter_id')->unsigned();
            $table->string('filter_key', 100);
            $table->json('filter_values')->nullable();
            $table->foreign('filter_id')->references('id')->on('user_saved_filters')->onDelete('cascade');
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
        Schema::dropIfExists('user_filters');
    }
}
