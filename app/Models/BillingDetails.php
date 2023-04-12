<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'address1',
        'address2',
        'city',
        'state',
        'phone',
        'email',
        'notes',
        'order_code'
    ];

    public function order ()
    {
        return $this->hasOne(Order::class, 'order_code', 'order_code');
    }
}
