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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('no_hp')->unique();
            $table->string('nama');
            $table->string('foto_profil')->nullable();
            $table->enum('role', ['Admin', 'Dosen', 'Siswa']);
            $table->string('jenjang');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('api_token')->unique()->nullable()->default(null);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
