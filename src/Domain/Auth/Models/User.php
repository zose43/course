<?php

namespace Domain\Auth\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    public const AVATAR_SERVICE = 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=';

    protected $fillable = [
        'name',
        'email',
        'password',
        'github_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'github_id',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar(): Attribute
    {
        return Attribute::get(fn() => self::AVATAR_SERVICE . $this->name);
    }
}
