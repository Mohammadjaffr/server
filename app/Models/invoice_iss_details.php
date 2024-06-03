<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice_iss_details extends Model
{
    use HasFactory;
    protected $guarded = [];
    use SoftDeletes;

    public function item()
    {
        return $this->belongsTo(item::class, 'item_id');
    }
    public function invoice_iss()
    {
        return $this->belongsTo(invoice_iss::class, 'issu_id');
    }
}
