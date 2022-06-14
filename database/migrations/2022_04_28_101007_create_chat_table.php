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
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->string("role");
            $table->string("pesan");
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamp('read_at')->nullable()->default(null);

            $table->unsignedBigInteger('id_chat_room');
            $table->foreign('id_chat_room')->references('id')->on('chat_room')->onDelete('cascade'); // If chat_room is deleted, the chat will be deleted as well
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('chat');
    }
};
