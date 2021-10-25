<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static gmb()
 * @method static static hackathon()
 * @method static static mentorship()
 * @method static static schoolAdoption()
 */
final class ProjectType extends Enum
{
    public const gmb = 1;
    public const hackathon = 2;
    public const mentorship = 3;
    public const schoolAdoption = 4;

    public function toArray()
    {
        return \Str::slug($this->description);
    }
}
