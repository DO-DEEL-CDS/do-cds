<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Approved()
 * @method static static Started()
 * @method static static AttendanceOpened()
 * @method static static Closed()
 */
final class TrainingStatus extends Enum
{
    public const Pending = 0;
    public const Approved = 1;
    public const Started = 3;
    public const AttendanceOpened = 4;
    public const Closed = 5;

    public function toArray()
    {
        return \Str::slug($this->description);
    }
}
