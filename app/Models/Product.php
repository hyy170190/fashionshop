<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'product_name',
        'type_name',
        'description',
        'price',
        'quantity',
        'deleted',
    ];

    // public function transaction()
    // {
    //     return $this->hasMany('App\Models\Transaction', 'product_id', 'id');
    // }

    public static function getRecord()
    {
        return DB::table('product')
            ->where('deleted', 0)
            ->orderby('id', 'asc')
            ->paginate(5);
    }
}
