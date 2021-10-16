<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'message',
        'status',
        'agent',
    ];

    protected $casts = [
        'status' => TicketStatus::class,
    ];


    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
