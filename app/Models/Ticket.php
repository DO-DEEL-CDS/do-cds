<?php

namespace App\Models;

use App\Enums\TicketStatus;
use App\Models\Roles\Admin;
use App\Models\Roles\Corper;
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
        'agent_id',
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
        return $this->belongsTo(Admin::class, 'agent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Corper::class);
    }
}
