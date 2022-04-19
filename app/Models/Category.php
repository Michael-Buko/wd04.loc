<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'img', 'parent_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getImgAttribute(){
        if (!empty($this->attributes['img'])){
            return $this->attributes['img'];
        }
        return 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';
    }

}
