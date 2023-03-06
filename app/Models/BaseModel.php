<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    use HasFactory;
    public static function booted(){
        parent::boot();
        static::creating(function ($model){
            $model->created_by = Auth::user()->id;
            $model->updated_by = Auth::user()->id;
        });
        static::updating(function ($model){
            $model->updated_by = Auth::user()->id;
        });
        static::softDeleted(function ($model){
            $model->deleted_by = Auth::user()->id;
        });
        static::restored(function ($model){
            $model->deleted_by = null;
        });
    }
}
