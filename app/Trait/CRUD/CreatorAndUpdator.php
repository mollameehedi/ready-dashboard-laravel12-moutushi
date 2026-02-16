<?php

namespace App\Trait\CRUD;

use App\Models\User;

trait CreatorAndUpdator
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->fillCreatedBy();
        });

        static::updating(function ($model){
            $model->fillUpdatedBy();
        });
    }

    public function fillCreatedBy()
    {
        $this->fill([
            'created_by' => auth()->id()
        ]);
    }

    public function fillUpdatedBy()
    {
        $this->fill([
            'updated_by' => auth()->id()
        ]);
    }

    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->select('name','id');
    }

    public function updated_user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id')->select('name','id');
    }
}
