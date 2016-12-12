<?php

namespace App\Presenters;

use Gtk\Presenter\Presenter;

class FooPresenter extends Presenter
{
    public function bar()
    {
        return 'foobar';
    }
}