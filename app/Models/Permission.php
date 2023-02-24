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
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];
    /**
     * define hasMany Relaionship with permission module
     */
    public function modules()
    {
        return $this->hasMany(PermissionModule::class, 'permission_id');
    }
    /**
     * define manyTomany relationship with Role using permission_role pivot table
     */
    public function role()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'role_id', 'permission_id', 'id', 'id');
    }
    /**
     * hasPermission method for checking acces of module
     * @param $module_code,$permission
     */
    public function hasPermission($module_code, $permission)
    {
        $module = Module::where('module_code', $module_code)->first();
        $data = $this->modules()->where('module_id', $module->id)->where($permission, true)->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
