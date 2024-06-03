<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=true;

    public function com()
    {
        return $this->belongsToMany(company::class,'item_com');
    }
    public function company()
    {
        return $this->belongsTo(company::class,'com_id');
    }


    public function store()
    {
        return $this->belongsTo(store::class);
    }
    public function packing()
    {
        return $this->belongsTo(packing::class,'pakcking_id');
    }
    public function stores()
    {
        return $this->belongsToMany(store::class,'store_item');
    }
}
