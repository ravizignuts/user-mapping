<?php

namespace App\Models;
use App\Traits\Uuids;
use App\Models\PermissionModule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use Uuids, HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];
    public function modules(){
        return $this->hasMany(PermissionModule::class,'permission_id');
    }
    public function role(){
        return $this->belongsToMany(Role::class,'permission_role','role_id','permission_id','id','id');
    }
}
