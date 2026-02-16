<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Banner extends Model  implements HasMedia
{
   use InteractsWithMedia;
   protected $fillable = [
    'name',
    'is_active',
];

public function scopeActive($query){
    return $query->where('is_active',true);
}
}
