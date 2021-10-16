<?php

namespace App\Extensions\Traits;


trait InitializesClass
{

    /**
     * @return self
     */
    public static function init()
    {
        $class = get_called_class();

        $object = app($class);

        if (!app()->has($class)) {
            app()->instance($class, $object);
        }

        return $object;
    }

}
