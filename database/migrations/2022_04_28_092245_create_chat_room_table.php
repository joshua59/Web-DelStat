<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_room', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_user_1');
            $table->foreign('id_user_1')->references('id')->on('users');

            $table->unsignedBigInteger('id_user_2');
            $table->foreign('id_user_2')->references('id')->on('users');

            $table->boolean('is_automatic_deleted')->default(true);

            $table->dateTime('last_edited_at')->default(now());
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
        Schema::dropIfExists('chat_room');
    }
};
