<?php

namespace Gtk\Presenter;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait Presentable
{
    /**
     * Create a presenter for the model.
     *
     * @return \Gtk\Presenter\Presenter
     */
    public function presenter()
    {
        $presenter = $this->getPresenterClass();

        if (! class_exists($presenter)) {
            return new NullPresenter($this);
        }

        return new $presenter($this);
    }

    /**
     * Get the presenter class associated with the model.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        if (property_exists($this, 'presenterClass')) {
            return $this->presenterClass;
        }

        return $this->presenterNamespace().class_basename($this).'Presenter';
    }

    /**
     * Get the presenter's namespace.
     *
     * @var string
     */
    public function presenterNamespace()
    {
        return property_exists($this, 'presenterNamespace') ? $this->presenterNamespace : 'App\\Presenters\\';
    }

    /**
     * Set the presenter class associated with the model.
     *
     * @param  string  $presenterClass
     * @return $this
     */
    public function setPresenterClass($presenterClass)
    {
        $this->presenterClass = $presenterClass;

        return $this;
    }

    /**
     * Create a new pivot model instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $parent
     * @param  array  $attributes
     * @param  string  $table
     * @param  bool  $exists
     * @return \Illuminate\Database\Eloquent\Relations\Pivot
     */
    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        $models = [class_basename($parent), class_basename($this)];

        sort($models);

        $newPivot = implode('', $models).'Pivot';

        if (class_exists($newPivot)) {
            return new $newPivot($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }
}