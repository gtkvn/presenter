<?php

namespace Gtk\Presenter;

use Illuminate\Support\Str;

trait Presentable
{
    /**
     * The presenter's namespace.
     *
     * @var string
     */
    protected $presenterNamespace = 'App\\Presenters\\';

    /**
     * The presenter associated with the model.
     *
     * @var string
     */
    protected $presenterClass;

    /**
     * Create a presenter for the model.
     *
     * @return \Gtk\Presenter\Presenter
     */
    public function presenter()
    {
        $presenter = $this->getPresenterClass();

        if (! class_exists($presenter)) {
            return new NullPresenter();
        }

        return new $presenter;
    }

    /**
     * Get the presenter class associated with the model.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        if (isset($this->presenterClass)) {
            return $this->presenterClass;
        }

        return $this->presenterNamespace.str_replace('\\', '', Str::snake(Str::plural(class_basename($this)))).'Presenter';
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