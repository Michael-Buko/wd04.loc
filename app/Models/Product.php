<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'img', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getSerialNumberAttribute()
    {
        return 'Ser.# ' . $this->attributes['id'];
    }

    public function getPriceAttribute()
    {
        return 'price: ' . $this->attributes['price'] / 100 . '$';
    }

    public function setPriceAttribute($value)
    {
        if ($value < 0) {
            throw new \Exception('incorrect price');
        }
        $this->attributes['price'] = (int)($value * 100);
    }
}
