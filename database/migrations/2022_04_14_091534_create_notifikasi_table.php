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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->string("jenis_notifikasi");
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger("id_literatur")->nullable();
            $table->foreign("id_literatur")->references("id")->on("literatur");
            $table->unsignedBigInteger("id_analisis_data")->nullable();
            $table->foreign("id_analisis_data")->references("id")->on("analisis_data");
            $table->boolean("sudah_dibaca")->default(false);
            $table->timestamps();
            $table->timestamp('read_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifikasi');
    }
};
