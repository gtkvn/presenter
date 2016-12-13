<?php

namespace App\Presenters;

use Gtk\Presenter\Presenter;

class FooPresenter extends Presenter
{
    public function fullName()
    {
        return $this->model->first_name.' '.$this->model->last_name;
    }
}