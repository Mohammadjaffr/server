<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class packing extends Model
{
    use HasFactory;
    protected $fillable=[

        'pk_code',
        'pk_des'
    ];
}
