<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static BatchAStream1()
 * @method static static BatchAStream2()
 * // * @method static static BatchAStream3()
 * @method static static BatchBStream1()
 * @method static static BatchBStream2()
 * // * @method static static BatchBStream3()
 * @method static static BatchCStream1()
 * @method static static BatchCStream2()
 * // * @method static static BatchCStream3()
 */
final class Batch extends Enum
{
    public const BatchAStream1 = 'BatchAStream1';
    public const BatchAStream2 = 'BatchAStream2';
    public const BatchBStream1 = 'BatchBStream1';
    public const BatchBStream2 = 'BatchBStream2';
    public const BatchCStream1 = 'BatchCStream1';
    public const BatchCStream2 = 'BatchCStream2';

    public static function asArray(): array
    {
        $array = parent::asArray();
        $selectArray = [];

        foreach ($array as $key => $value) {
            $selectArray[$value] = ucwords(self::getFriendlyKeyName($value));
        }

        return $selectArray;
    }

    public function toArray(): string
    {
        return ucwords($this->description);
//      return preg_replace('/(\d+)/', '20$0 Batch ', $this->value);
    }

    public function shorValue(): string
    {
        return ucfirst($this->description[6]);
    }
}
