<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
            'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
            'password',
            'remember_token',
            'email_verified_at',
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

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(TrainingAttendance::class);
    }

    public function businesses(): HasMany
    {
        return $this->hasMany(GmbSubmission::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author');
    }

    public function training(): HasMany
    {
        return $this->hasMany(Training::class, 'created_by', 'id');
    }

    public function getPasswordResetCode()
    {
        $expires = config('auth.passwords.users.expire');
        return $this->passwordReset()
                ->whereDate('created_at', '>=', now()->subtract($expires . ' minutes'))
                ->firstOrCreate([], ['token' => generate_otp(new PasswordReset(), 'token')])->token;
    }

    private function passwordReset(): HasOne
    {
        return $this->hasOne(PasswordReset::class, 'email', 'email');
    }

    public function deletePasswordResetCode(): void
    {
        $this->passwordReset()->delete();
    }

    public function scopeSearch(Builder $builder, array $search): void
    {
        if (!empty($search['search'])) {
            $builder->where('name', 'like', $search['search'] . '%');
            $builder->orWhere('email', 'like', $search['search'] . '%');
            $builder->orWhereHas('profile', function ($q) use ($search) {
                $q->where('nysc_state_code', 'like', $search['search'] . '%');
            });
        }
    }

    public function routeNotificationForOneSignal()
    {
        return $this->device_id;
    }

}
