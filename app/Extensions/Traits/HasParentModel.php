<?php

namespace App\Extensions\Traits;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Str;
use ReflectionClass;

trait HasParentModel
{
    public static function bootHasParent()
    {
        // This adds support for using Parental with standalone Eloquent, outside a normal Laravel app.
        if (static::getEventDispatcher() === null) {
            static::setEventDispatcher(new Dispatcher());
        }

        static::creating(function ($model) {
            if ($model->parentHasHasChildrenTrait()) {
                $model->forceFill(
                    [$model->getInheritanceColumn() => $model->classToAlias(get_class($model))]
                );
            }
        });
    }

    public function getTable()
    {
        if (!isset($this->table)) {
            return str_replace('\\', '', Str::snake(Str::plural(class_basename($this->getParentClass()))));
        }

        return $this->table;
    }

    /**
     * Get the class name for Parent Class.
     *
     * @return string
     * @throws \ReflectionException
     */
    protected function getParentClass(): string
    {
        static $parentClassName;

        return $parentClassName ?: $parentClassName = (new ReflectionClass($this))->getParentClass()->getName();
    }

    public function getForeignKey(): string
    {
        return Str::snake(class_basename($this->getParentClass())) . '_' . $this->primaryKey;
    }

    public function joiningTable($related, $INSTANCE = null): string
    {
        $models = [
            Str::snake(class_basename($related)),
            Str::snake(class_basename($this->getParentClass())),
        ];
        sort($models);

        return strtolower(implode('_', $models));
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getClassNameForRelationships(): string
    {
        return class_basename($this->getParentClass());
    }

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     * @throws \ReflectionException
     */
    public function getMorphClass(): string
    {
        $parentClass = $this->getParentClass();
        return (new $parentClass)->getMorphClass();
    }

    /**
     * @return bool
     */
    public function parentHasHasChildrenTrait()
    {
        return $this->hasChildren ?? false;
    }

}
