<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Traits\QueryTrait;
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
}
