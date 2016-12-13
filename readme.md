# Simple View Presenters

Sometimes a bit of logic needs to be performed before some data (for example, from your model) is displayed from the view. A view presenter is an useful way to perform the view related logic clearly instead of hard-coding the logic into the view or storing the logic in the model.

## Install

Install this package via the Composer package manager:

```js
composer require gtk/presenter
```

## Usage

Fist, store your presenters somewhere with the default namespace is `App\Presenters`. Here is an example of a presenter:

```php
namespace App\Presenters;

use Gtk\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function fullName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function lastLogin()
    {
        return $this->last_login->diffForHumans();
    }
}
```

Next, on your model, pull in the `Presentable` trait, which will automatically instantiate your presenter class. By default, the presenter class associated with the model `User` is `App\Presenters\UserPresenter`. Here's an example of a model:

```php
<?php

namespace App\Models;

use Gtk\Presenter\Presentable;

class User extends Model
{
    use Presentable;
}
```

Now, within your view, instead of:

```php
    <h1>Hello, {{ $user->first_name.' '.$user->last_name }}!</h1>
    <p>Last login on {{ $user->last_login->diffForHumans() }}.</p>
```

You can do:

```php
    <h1>Hello, {{ $user->presenter()->fullName }}!</h1>
    <p>Last login on {{ $user->presenter()->lastLogin }}.</p>
```

You can specific the presenter class associated with the model via the following properties of `Presentable` trait:

- `$presenterClass`: specific entirely the presenter class's name included its namespace. For example, `protected $presenterClass = 'Acme\Presenters\User'`.

- `$presenterNamespace`: specific the presenter class's namespace. For example, `protected $presenterNamespace = 'Acme\Presenters'`.

- `$presenterClassSuffix`: specific the presenter class's suffix. For example, with `protected $presenterClassSuffix = 'View';`, the presenter class associated with the model `User` is `UserView` instead of `UserPresenter`.

## License

Simple View Presenters is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
