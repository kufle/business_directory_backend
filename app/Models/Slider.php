<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected function getImageUrlAttribute()
    {
        if(file_exists(public_path().'/assets/images/sliders/'.$this->image) && $this->image) {
            return asset('assets/images/sliders/'.$this->image);
        }else{
            return asset('assets/images/sliders/default.png');
        }
    }
}
