<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Active()
 * @method static static Inactive()
 */
final class ProjectStatus extends Enum
{
    public const Pending = 0;
    public const Active = 1;
    public const Inactive = 2;

    public function toArray()
    {
        return $this->description;
    }
}
