<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public function businesses(): HasMany
    {
        return $this->hasMany(Business::class);
    }

    protected function getImageUrlAttribute()
    {
        if(file_exists(public_path().'/assets/images/category/'.$this->image) && $this->image) {
            return asset('assets/images/category/'.$this->image);
        }else{
            return asset('assets/images/category/default.png');
        }
    }
}
