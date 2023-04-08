<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'size', 'unit_price', 'category', 'status', 'description'
    ];

    public static function getRecord(array $search): \Illuminate\Database\Eloquent\Collection
    {
        $query = self::query();

        $query->when(data_get($search, 'product_order_by'), function ($q, $orderBy) {
            $q->orderBy('unit_price', $orderBy == 1 ? 'ASC' : 'DESC');
        });

        $query->when(data_get($search, 'categories'), function ($q, $categories) {
            $q->whereIn('category', $categories);
        });

        $query->when(data_get($search, 'size'), function ($q, $size) {
            $q->where('size', $size);
        });

        return $query->get();
    }
}
