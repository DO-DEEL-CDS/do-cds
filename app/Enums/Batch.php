<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static BatchAStream1()
 * @method static static BatchBStream2()
 * @method static static BatchCStream3()
 */
final class Batch extends Enum
{
    public const BatchAStream1 = 'BatchAStream1';
    public const BatchBStream2 = 'BatchBStream2';
    public const BatchCStream3 = 'BatchCStream3';


    public function toArray()
    {
        return ucwords($this->description);
//      return preg_replace('/(\d+)/', '20$0 Batch ', $this->value);
    }
}
