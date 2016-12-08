<?php

namespace Gtk\Presenter;

abstract class Presenter
{
    /**
     * The model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new presenter instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Dynamically retrieve attributes on the presenter.
     *
     * @param  string  $property
     * @return mixed
     */
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