<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TrainingStatus extends Enum
{
    public const Pending = 0;
    public const Approved = 1;
}
