<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Draft()
 * @method static static Pending()
 * @method static static Published()
 */
final class ArticleStatus extends Enum
{
    public const Draft = 0;
    public const Pending = 1;
    public const Published = 2;

    public function toArray()
    {
        return $this->description;
    }
}
