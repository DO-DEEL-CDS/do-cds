<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'device_id',
        'status',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => UserStatus::class
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function getPasswordResetCode()
    {
        $expires = config('auth.passwords.users.expire');
        return $this->passwordReset()
            ->whereDate('created_at', '>=', now()->subtract($expires . ' minutes'))
            ->firstOrCreate([], ['token' => generate_otp(new PasswordReset(), 'token')])->token;
    }

    public function deletePasswordResetCode()
    {
        $this->passwordReset()->delete();
    }

    private function passwordReset()
    {
        return $this->hasOne(PasswordReset::class, 'email', 'email');
    }
}
