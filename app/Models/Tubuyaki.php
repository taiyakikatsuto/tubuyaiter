<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tubuyaki extends Model
{
    use HasFactory;

    protected $fillable = [
        'contents'
    ];

    /**
     * つぶやきの画像を取得
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
