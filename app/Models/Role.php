<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Role extends BaseModel
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
     * define manyTomany relationship with Pemission using permission_roles pivot table
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles');
    }
    /**
     * define manyTomany relationship with User using role_users pivot table
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }
    /**
     * pass parameter through relationship
     * * @param $module_code,$permission
     */
    public function hasRole($module_code, $permission)
    {
        return $this->permissions()->first()->hasPermission($module_code, $permission);
    }
}
