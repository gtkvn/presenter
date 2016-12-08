<?php

namespace Gtk\Presenter;

use Illuminate\Support\Str;

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
}