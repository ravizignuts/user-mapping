<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Uuids;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use Uuids, QueryTrait, HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'module_code',
        'name',
        'is_active',
        'is_in_menu',
        'display_order'
    ];

    public static function booted(){
        parent::boot();
        static::creating(function (Module $module){
            $user = Auth::user();
            $module->created_by = $user->id;
            $module->updated_by = $user->id;
        });
        static::updating(function (Module $module){
            $user = Auth::user();
            $module->updated_by = $user->id;
        });
        static::softDeleted(function (Module $module){
            $user = Auth::user();
            $module->deleted_by = $user->id;
        });
        static::restored(function (Module $module){
            $module->deleted_by = null;
        });
    }
}
