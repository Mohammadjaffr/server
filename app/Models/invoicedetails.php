<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoicedetails extends Model
{
    use HasFactory;

    protected $guarded = [];
    use SoftDeletes;

    public function item()
    {
        return $this->belongsTo(item::class, 'item_id');
    }

    public function receivingInvoice()
    {
        return $this->belongsTo(ReceivingInvoice::class, 'rec_id');
    }
}
