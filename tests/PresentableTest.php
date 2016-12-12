<?php

use Gtk\Presenter\Presenter;
use Gtk\Presenter\Presentable;

class PresentableTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function a_presentable_model_can_use_a_presenter()
    {
        $presenter = (new Foo)->presenter();

        $this->assertEquals('App\Presenters\FooPresenter', get_class($presenter));

        $this->assertEquals('foobar', $presenter->bar);
    }
}

class Foo
{
    use Presentable;
}