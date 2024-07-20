<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'about',
        'address',
        'contact',
        'image',
        'website',
        'rate'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    protected function getImageUrlAttribute()
    {
        if(file_exists(public_path().'/assets/images/business/'.$this->image) && $this->image) {
            return asset('assets/images/business/'.$this->image);
        }else{
            return asset('assets/images/business/default.png');
        }
    }
}
