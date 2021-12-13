<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use Str;

/**
 * @method static static Pending()
 * @method static static Active()
 * @method static static Completed()
 */
final class ProjectStatus extends Enum
{
    public const Pending = 0;
    public const Active = 1;
    public const Completed = 2;

    public function toArray()
    {
        return Str::snake($this->description);
    }
}
