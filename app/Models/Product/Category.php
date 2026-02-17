<?php

namespace App\Models\Product;

use App\Enums\Common\ActiveStatus;
use App\Trait\CRUD\CreatorAndUpdator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Action;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model  implements HasMedia
{
    use CreatorAndUpdator,HasFactory,InteractsWithMedia;

    protected $fillable = ['name', 'status', 'slug','is_feature','feature_status','created_by','updated_by'];
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
            $model->fillUpdatedBy();
        });
    }

    // relation
    public function subCategories(){
        return $this->hasMany(SubCategory::class,'category_id','id');
    }

    public function products(){
        return $this->hasMany(Product::class)->shortData();
    }
    public function categoryProducts(){
        return $this->hasMany(Product::class)->shortData()->take(8);
    }
    public function scopeActive($query){
        return $query->where('status',ActiveStatus::Active->value);
    }
    public function scopeShortData($query){
        return $query->active()->select('id','name','slug');
    }

    public function scopeFeatureCategory($query){
        return $query->active()->where('is_feature',1);
    }
    public function scopeActiveFeature($query){
        return $query->featureCategory()->where('feature_status',ActiveStatus::Active->value)->with('products');
    }
    public function scopeActiveSubCategory($query){
        return $query->subCategories()->active();
    }
}
