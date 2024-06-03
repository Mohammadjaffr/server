<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'Unit_code',
        'Unit_des',
        'packing_id'
    ];
    public function pk()
    {
        return $this->belongsTo(packing::class,'packing_id');
    }
}
