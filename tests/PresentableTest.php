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

    /** @test */
    public function a_presentable_model_can_use_null_presenter_if_no_presenter_associated()
    {
        $presenter = (new Bar)->presenter();

        $this->assertEquals('Gtk\Presenter\NullPresenter', get_class($presenter));
    }

    /** @test */
    public function a_presentable_model_can_customize_the_presenter_class_name()
    {
        $presenter = (new FooWithCustomName)->setPresenterClass('FooPresenterWithCustomName')->presenter();

        $this->assertEquals('FooPresenterWithCustomName', get_class($presenter));

        $this->assertEquals('foobar', $presenter->bar);
    }

    /** @test */
    public function a_presentable_model_can_customize_the_presenter_namespace_and_suffix()
    {
        $presenter = (new FooWithCustomNamespace)->presenter();

        $this->assertEquals('Baz\Zonda\FooWithCustomNamespaceViewPresenter', get_class($presenter));

        $this->assertEquals('foobar', $presenter->bar);
    }
}

class Foo
{
    use Presentable;
}

class Bar
{
    use Presentable;
}

class FooWithCustomName
{
    use Presentable;
}

class FooPresenterWithCustomName extends Presenter
{
    public function bar()
    {
        return 'foobar';
    }
}

class FooWithCustomNamespace
{
    use Presentable;

    protected $presenterNamespace = 'Baz\\Zonda';

    protected $presenterClassSuffix = 'ViewPresenter';
}