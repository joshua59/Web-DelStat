<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Literatur extends Model
{
    use HasFactory;

    protected $table = "literatur";

    protected $fillable = [
        'id_user',
        'judul',
        'tag',
        'file',
    ];
}
