# A Laravel Nova card to greet your users

[![Latest Version on Packagist](https://img.shields.io/packagist/v/oriondevelops/nova-greeter.svg?style=flat-square)](https://packagist.org/packages/oriondevelops/nova-greeter)
[![Total Downloads](https://img.shields.io/packagist/dt/oriondevelops/nova-greeter.svg?style=flat-square)](https://packagist.org/packages/oriondevelops/nova-greeter)

This [Laravel Nova](https://nova.laravel.com) package adds a customizable greeting card to your dashboard.

## Installation

You can install the package via composer:

```bash
composer require oriondevelops/nova-greeter
```

## Usage

[Register the card](https://nova.laravel.com/docs/4.0/customization/dashboards.html#defining-dashboards) in your preferred dashboard:

```php
use Orion\NovaGreeter\GreeterCard;

// ...

public function cards()
{
    return [
        // ...
        GreeterCard::make()
            ->user(name: 'John Doe', title: 'The King in the North')
            ->avatar(url: 'https://ui-avatars.com/api/?size=300&color=7F9CF5&background=EBF4FF&name=John+Doe'),
    ];
}
```

**Message**

```php
->message(text: 'Welcome back,')
```

**Button**
```php
->button(name: 'Call To Action', target: '/nova/resources/users')
```

**Avatar**
```php
->avatar(url: $avatarUrl ?? $placeholderAvatarUrl)
```

## Example

```php
GreeterCard::make()
    ->user(name: 'ORION', title: 'Admin')
    ->message(text: 'Welcome back,')
    ->button(name: 'See users', target: '/nova/resources/users')
    ->avatar(url: 'https://avatars.githubusercontent.com/u/39307250')
    ->width('1/2'),
```

## Localization

The translation file can be published using the following command:

```bash
php artisan vendor:publish --provider="Orion\NovaGreeter\CardServiceProvider"
```

## Credits

- [Mücahit Uğur](https://github.com/oriondevelops)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.