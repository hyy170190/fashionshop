<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['name', 'email', 'message'];

    public function routeNotificationForMail($notification)
    {
        // Return email address only...
        return $this->email;

    }
}
