<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static B21A()
 * @method static static B21B()
 * @method static static B21C()
 * @method static static B22A()
 * @method static static B22B()
 * @method static static B22C()
 * @method static static B23A()
 * @method static static B23B()
 * @method static static B23C()
 */
final class Batch extends Enum
{
    public const B21A = '21A';
    public const B21B = '21B';
    public const B21C = '21C';
    public const B22A = '22A';
    public const B22B = '22B';
    public const B22C = '22C';
    public const B23A = '23A';
    public const B23B = '23B';
    public const B23C = '23C';

    public function toArray()
    {
        return preg_replace('/(\d+)/', '20$0 Batch ', $this->value);
    }
}
