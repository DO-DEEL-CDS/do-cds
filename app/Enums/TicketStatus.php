<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static New()
 * @method static static Awaiting_Customer()
 * @method static static Awaiting_Agent()
 * @method static static On_Hold()
 * @method static static Resolved()
 * @method static static Closed()
 */
final class TicketStatus extends Enum
{
    public const New = 0;
    public const Awaiting_Customer = 1;
    public const Awaiting_Agent = 2;
    public const On_Hold = 3;
    public const Resolved = 4;
    public const Closed = 5;
}
