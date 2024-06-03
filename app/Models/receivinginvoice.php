<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class receivinginvoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['invoice_Date'];

    public function details()
    {
        return $this->hasMany(InvoiceDetails::class, 'rec_id', 'id');
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
        return $this->belongsTo(Store::class, 'store_id');
    }

}
