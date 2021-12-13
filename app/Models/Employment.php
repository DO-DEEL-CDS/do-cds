<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
            'title',
            'location',
            'description',
            'role',
            'type',
            'apply_link',
            'rate',
            'perks',
            'closing_date',
    ];

    protected $casts = [
            'perks' => 'array'
    ];

    protected $dates = [
            'closing_date'
    ];

    protected $with = [
            'employer'
    ];

    protected $hidden = [
            'employer_id'
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function scopeOpen($builder)
    {
        $builder->whereDate('closing_date', '>=', now());
    }

    public function scopeSearch($builder, array $search)
    {
        if (!empty($search['role'])) {
            return $builder->whereRole($search['role']);
        }

        if (!empty($search['type'])) {
            return $builder->whereType($search['type']);
        }
    }
}
