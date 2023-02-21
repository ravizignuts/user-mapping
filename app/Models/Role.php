<?php

namespace App\Models;
use App\Traits\Uuids;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use Uuids;
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_roles');
    }
}
