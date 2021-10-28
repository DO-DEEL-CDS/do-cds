<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Inactive()
 * @method static static InTraining()
 * @method static static Active()
 */
final class UserStatus extends Enum
{
    public const Inactive = 0;
    public const InTraining = 1;
    public const Active = 2;

    public function toArray(): string
    {
        return \Str::snake($this->description);
    }
}
