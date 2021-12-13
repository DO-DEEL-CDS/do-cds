<?php

namespace App\Models;

use App\Extensions\Traits\ModelDoesUploads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory, ModelDoesUploads;

    public array $uploadable = ['photo'];

    protected $guarded = ['id'];

    protected $fillable = [
            'photo',
            'phone_number',
            'nysc_call_up_number',
            'nysc_state_code',
            'state_code',
            'deployed_state'
    ];

    protected $hidden = [
            'created_at',
            'deleted_at',
            'state_code',
            'user_id',
    ];

    protected $appends = [
            'photo_url'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_code', 'state_code');
    }

    public function getPhotoUrlAttribute($value)
    {
        return url($this->photo);
    }
}
