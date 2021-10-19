# Laravel Presenter

A package that helps to group methods that mostly use for the view presentation purpose.

## Installation

Require the package using composer:

```bash
composer require touhidurabir/laravel-presenter
```

To publish the config file:
```bash
php artisan vendor:publish --provider="Touhidurabir\Presenter\PresenterServiceProvider" --tag=config
```

## Configurations
Check the published config file for the details of configurations options.

## Usage
First step is to generate a presenter class . To make this process easy, this package comes with a command that helps to generate the presenter classes. To generate the presenter class via command, do as 

```bash
php artisan make:presenter PresenterClassName
```

For example : 

```bash
php artisan make:presenter UserPresenter
```

will generate a **UserPresenter** at the **App\Presenters** namespaced path. 

it will have following content 

```php
namespace Touhidurabir\Presenter\Tests\App\Presenters;

use Touhidurabir\Presenter\BasePresenter;

class UserPresenter extends BasePresenter {

}
```

Now to use this with the combination of **User** model class, drop the **HasPresenter** trait and defined property **$presenter** as : 

```php
use Illuminate\Database\Eloquent\Model;
use Touhidurabir\Presenter\HasPresenter;
use Touhidurabir\Presenter\Tests\App\Presenters\UserPresenter;

class User extends Model {

    use HasPresenter;

    protected $presenter = UserPresenter::class;
}
```

And Now any **public** method defined in the **UserPresenter** class can be accesses as : 

```php
$user->present()->someMethod
```

>It is also possible to not define the **$presenter** property while using the presenter class for models . In that case it will try to resolve the presenter through the model name and defaule store namespace defined in the **config** file . 
>
>For example, by default it will try to find a class in the **App\Presenters** location with name of **UserPresenter** for **User** model if the **$presenter** property not set in the **User model**. If it can find it, then it will use that for **User** model presenter . If none found, it will throw exception.

It is also possible to set/update the presenter on fly . To do that , need to user the **setPresenter** method defined in the **HasPresenter** trait as : 

```php
$user->setPresenter(UserPresenter::class);
$user->present()->anyMethodDefinedInPresenter;
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](./LICENSE.md)
