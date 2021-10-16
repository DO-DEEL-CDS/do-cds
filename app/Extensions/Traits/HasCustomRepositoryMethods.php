<?php

namespace App\Extensions\Traits;


trait HasCustomRepositoryMethods
{

    public function bulkDelete(array $ids)
    {
        $this->getModel()->newQuery()->whereIn('id', $ids)->delete();
    }

}
