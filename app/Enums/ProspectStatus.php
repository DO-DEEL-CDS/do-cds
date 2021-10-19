<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Approved()
 * @method static static Denied()
 */
final class ProspectStatus extends Enum
{
    public const Pending = 0;
    public const Approved = 1;
    public const Denied = 2;


    public function toArray()
    {
        return $this->description;
    }
}
