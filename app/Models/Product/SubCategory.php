<?php

namespace App\Models\Product;

use App\Enums\Common\ActiveStatus;
use App\Trait\CRUD\CreatorAndUpdator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    use CreatorAndUpdator,HasFactory;
    protected $fillable = ['name', 'status', 'category_id', 'slug', 'created_by', 'updated_by'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function scopeShortData($query){
        return $query->latest()->select('id','name','slug');
    }
      protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
            $originalSlug = $model->slug;
            $count = 1;
            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug . '-' . $count++;
            }
            $model->fillCreatedBy();
        });

        static::updating(function ($model){
             $model->slug = Str::slug($model->name);
            $originalSlug = $model->slug;
            $count = 1;
            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug . '-' . $count++;
            }
            $model->fillUpdatedBy();
        });
    }
     public function scopeActive($query){
        return $query->whereHas('category',function($query){
            $query->active();
        })->where('status',ActiveStatus::Active->value);
     }
}
