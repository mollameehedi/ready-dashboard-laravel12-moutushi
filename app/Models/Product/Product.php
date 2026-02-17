<?php

namespace App\Models\Product;

use App\Enums\Product\ProductHighLight;
use App\Models\User;
use App\Services\FlashSaleService;
use App\Services\PriceCalculationService;
use App\Trait\CRUD\CreatorAndUpdator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Product extends Model implements HasMedia
{
    use CreatorAndUpdator,InteractsWithMedia,HasFactory;
    protected $fillable = [
        'title',
        'product_code',
        'slug',
        'short_description',
        'long_description',
        'quantity',
        'alert_quantity',
        'price',
        'pre_price',
        'highlight',
        'status',
        'category_id',
        'sub_category_id',
        'models',
        'colors',
        'sizes',
        'meta_tag',
        'meta_title',
        'meta_description',
        'created_by',
        'updated_by',
        'is_active'
    ];
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb');
        $this->addMediaConversion('multiple_image');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->fillCreatedBy();

            $model->slug = Str::slug($model->title);
            $originalSlug = $model->slug;
            $count = 1;
            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug . '-' . $count++;
            }


        });

        static::updating(function ($model){
            $model->fillUpdatedBy();
        });
    }

    public function scopeDecodedData($query)
    {
        $query->select('*'); // Select all original columns
        $query->addSelect([
            'decoded_colors' => function ($q) {
                $q->selectRaw('JSON_EXTRACT(colors, "$")');
            },
            'decoded_sizes' => function ($q) {
                $q->selectRaw('JSON_EXTRACT(sizes, "$")');
            },
        ]);
        return $query;
    }
    /**
     * Get the category that this product belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the subcategory that this product belongs to.
     */
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

     /**
     * Get the user that created this product.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function flashProduct()
    {
        return $this->hasOne(FlashSaleProduct::class);
    }
     public function flashSaleProduct()
    {
        return $this->hasOne(FlashSaleProduct::class);
    }
     public function flashSaleAcProducts()
    {
        return $this->hasMany(FlashSaleProduct::class,'product_id','id');
    }

    /**
     * Get the user that last updated this product.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
       public function scopeActive($query){
        return $query->whereHas('category',function($query){
            $query->active();
        })->whereHas('subCategory',function($query){
            $query->active();
        })->where('is_active',true);
    }
    // public function scopeActive($query){
    //     return $query->latest()->where('is_active',true);
    // }
    public function scopeShortData($query){
        return $query->active()->select('id','title','slug','price','pre_price','category_id')->with('media');
    }
    public function productStock()
    {
        return $this->hasMany(ProductStock::class, 'product_id', 'id');
    }
    public function scopeBest($query){
        return $query->where('highlight',ProductHighLight::Best->value);
    }
    public function scopePopular($query){
        return $query->where('highlight',ProductHighLight::Popular->value);
    }
    public function scopeNew($query){
        return $query->where('highlight',ProductHighLight::New->value);
    }
       public function getFinalPriceAttribute()
    {
        $priceCalculationService = app(FlashSaleService::class);

        // Use the service to calculate the price for this product instance.
        return $priceCalculationService->calculatePrice($this);
    }

    public function scopeFlashActivehProducts($query){
        $flash = FlashSale::activeFlash()->first();
        if(!$flash){
            return null;
        }
         return  $query->whereHas('flashSaleAcProducts',function($q){
            $q->where('quantity','>',DB::raw('sold_quantity'))->active()
            ->whereHas('flashSale',function($pf){
                $pf->where('is_current',1)
                    ->where("end_time",'>',Carbon::now())
                    ->where("start_date",'<',Carbon::now());
            });
         });
    }
    public function scopeFlashAvailable($query)
    {
        $flash = FlashSale::activeFlash()->first();
        if(!$flash){
            return null;
        }
        return $query->whereHas('flashSaleAcProducts', function ($q) use($flash) {
                $q->active()
                  ->whereColumn('quantity', '>', 'sold_quantity')->where('flash_sale_id',$flash->id);
            });
    }


}
