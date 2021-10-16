<?php


namespace App\Extensions\Traits;

/**
 * Trait DeletesQuietly
 * @package App\Traits
 *
 * @property boolean $is_deleted
 */
trait DeletesQuietly
{

    public function markAsDeleted()
    {
        $this->is_deleted = true;
        $this->update();
        event('model.deleted-quietly', $this);
    }

    public function scopeWithoutDeleted($query)
    {
        return $query->where('is_deleted', false);
    }

}
