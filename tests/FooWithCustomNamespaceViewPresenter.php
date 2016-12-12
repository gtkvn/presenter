<?php

namespace Baz\Zonda;

use Gtk\Presenter\Presenter;

class FooWithCustomNamespaceViewPresenter extends Presenter
{
    public function bar()
    {
        return 'foobar';
    }
}