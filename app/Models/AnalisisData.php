<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisData extends Model
{
    use HasFactory;

    protected $table = "analisis_data";

    protected $fillable = [
        'id_user',
        'judul',
        'file',
        'deskripsi',
    ];
}
