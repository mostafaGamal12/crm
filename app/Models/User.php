<?php

namespace App\Models;

use App\Filters\Filters;
use App\Scopes\ActiveScope;
use App\Traits\CompanyTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles, CompanyTrait;

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope(new ActiveScope);
    // }


    protected $fillable = [
        'first_name', 'last_name', 'job_title', 'profile_photo', 'about', 'linkedin', 'facebook', 'instgram', 'twitter', 'email', 'active', 'password', 'phone',
    ];
    protected $appends = ["full_name"];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function fcmTokens(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FcmToken::class, 'user_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}