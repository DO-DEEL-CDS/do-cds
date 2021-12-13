<?php

namespace App\Models\Roles;

use App\Extensions\Traits\AuthenticatableRoles;
use App\Extensions\Traits\HasParentModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Str;

/**
 * @extends User
 */
class Corper extends User
{
    use HasParentModel, AuthenticatableRoles;

    protected static string $role = 'corper';

    public function scopeState(Builder $builder, string $stateCode): void
    {
        $builder->whereHas('profile', static function (Builder $q) use ($stateCode) {
            $q->where('profiles.state_code', $stateCode);
        });
    }

    public function scopeYear(Builder $builder, string $year): void
    {
        if (Str::length($year) > 2) {
            $year = substr($year, 2, 2);
        }
        $builder->whereHas('profile', static function (Builder $q) use ($year) {
            $q->where('profiles.nysc_state_code', 'regex', '[a-z]{2}\/' . $year . '[a-z]\/*');
        });
    }

    public function scopeBatch(Builder $builder, string $batch): void
    {
        $builder->whereHas('profile', static function (Builder $q) use ($batch) {
            $q->where('profiles.nysc_state_code', 'regex', '[a-z]{2}\/\[:digit:]{2}B' . $batch . '\/*');
        });
    }
}
