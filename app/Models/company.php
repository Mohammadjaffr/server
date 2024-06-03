<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='companies';
    public function items()
    {
        return $this->belongsToMany(item::class,'item_com');
    }
}
