<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification_app', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name',100)->nullable();
            $table->string('messaged',100)->nullable();
            $table->string('commented',100)->nullable();
            $table->string('age',100)->nullable();
            $table->string('distance',100)->nullable();
            $table->text('text')->nullable();
            $table->tinyInteger('is_remove');
            $table->tinyInteger('is_viewed');
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
        Schema::dropIfExists('user_notification_app');
    }
}
