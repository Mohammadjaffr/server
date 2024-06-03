<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice_iss extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['invoice_Date'];

    public function details()
    {
        return $this->hasMany(invoice_iss_details::class, 'issu_id', 'id');
    }
    public function vend()
    {
        return $this->belongsTo(Vendor::class, 'vend_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'stor_id');
    }
    public function client()
    {
        return $this->belongsTo(client::class, 'client_id');
    }

    public function transport()
    {
        return $this->belongsTo(transport::class, 'transport_id');
    }
    public function digger()
    {
        return $this->belongsTo(digger::class, 'digger_id');
    }

}
