<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\addColumnObserver;
use App\Observers\UserObserver;
use App\Traits\Uuids;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Uuids, HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'is_active',
        'is_first_login',
        'code',
        'type'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * define manyTomany relationship with Role using role_users pivot table
     */
    public function roles(){
        return $this->belongsToMany(Role::class,'role_users');
    }
    /**
     * pass parameter of middleware through relationship
     * * @param $module_code,$permission
     */
    public function hasUser($module_code,$permission){
        return $this->roles()->first()->hasRole($module_code,$permission);
    }


    public static function booted(){
        parent::boot();
        static::creating(function (User $user){
            $user->created_by = $user->id;
            $user->updated_by = $user->id;
        });
        static::updating(function (User $user){
            $user = Auth::user();
            $user->updated_by = $user->id;
        });
    }

    // public static function boot(){
    //     parent::boot();
    //     $user = new User();
    //     $id = $user['id'];
    //     User::observe(new addColumnObserver($user,$id));

        // User::observe(new UserObserver($user->id));
    // }
}
