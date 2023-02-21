<?php

namespace App\Models;
use App\Traits\Uuids;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{
    use Uuids,HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_roles');
    }
}
