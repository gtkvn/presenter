<?php

namespace Gtk\Presenter;

abstract class Presenter
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return call_user_func([$this, $property]);
        }

        throw new \Exception(
            sprintf('%s does not respond to the "%s" property or method.', static::class, $property)
        );
    }
}