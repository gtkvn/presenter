<?php

use Gtk\Presenter\Presenter;
use Gtk\Presenter\Presentable;

class PresentableTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function a_presentable_model_can_use_a_presenter()
    {
        $this->assertEquals('foobar', (new Foo)->presenter()->bar);
    }
}

class Foo
{
    use Presentable;

    protected $presenterClass = 'FooPresenter';
}

class FooPresenter extends Presenter
{
    public function bar()
    {
        return 'foobar';
    }
}