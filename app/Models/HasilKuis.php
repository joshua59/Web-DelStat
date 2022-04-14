<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKuis extends Model
{
    use HasFactory;

    protected $table = "hasil_kuis";

    protected $fillable = [
        'id_user',
        'nama_user',
        'nilai_kuis',
    ];
}
