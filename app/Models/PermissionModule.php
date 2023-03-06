<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionModule extends Model
{
    use Uuids;
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'permission_id',
        'module_id',
        'add_access',
        'edit_access',
        'delete_access',
        'view_access'
    ];
}
