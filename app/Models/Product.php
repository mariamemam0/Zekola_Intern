<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (float $value) => '$' . number_format($value, 2), // 999.9 → "$999.90"
        );
    }
}
