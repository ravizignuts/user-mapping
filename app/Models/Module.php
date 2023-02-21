<?php

namespace App\Models;
use App\Traits\Uuids;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use Uuids;
    use HasFactory;
    protected $fillable = [
        'module_code',
        'name',
        'is_active',
        'is_in_menu',
        'display_order'
    ];
    public function permission(){
         return $this->belongsToMany(Permission::class,'permission_modules','module_id','permission_id','id','id');
    }
}
