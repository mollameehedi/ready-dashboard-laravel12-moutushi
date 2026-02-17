<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use  InteractsWithMedia;
    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection('logos');
        $this->addMediaCollection('favicons');
        $this->addMediaCollection('defaults');
    }

        protected $fillable = ([
            'name',
            'value'
        ]);
        public static function getByName($name, $default = null)
        {
            $setting = self::where('name', $name)->first();

            if (isset($setting)) {
                return $setting->value;
            }
            return $default;
        }
}
