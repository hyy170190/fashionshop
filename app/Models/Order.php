<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory;

    use Notifiable;

    protected $fillable = ['user_id', 'order_code', 'total_price', 'status','deliever'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function billingDetails ()
    {
        return $this->hasOne(BillingDetails::class,'order_code', 'order_code');
    }
}
