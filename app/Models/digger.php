<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class digger extends Model
{
    use HasFactory;
    protected $fillable=[
        'Rig_name',
        'Well_no',
    ];
}
