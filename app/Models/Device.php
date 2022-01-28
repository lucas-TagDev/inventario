<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'patri', 'sn', 'name', 'user', 'setor', 'brand', 'model', 'type', 'status', 'image'
    ];
}
