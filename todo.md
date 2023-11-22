# Training at UMPSA

## Project

During this course, a project called Task Management will be used as a requirement for building an application with Laravel framework.

Task Management System will have:

-   [x] Tasks CRUD

    -   [x] Migration
        -   [x] title
        -   [x] status
        -   [x] owner of task
    -   [x] Factory
    -   [x] Seeder
    -   [x] Model

-   [x] Authentication
-   [ ] Authorization
-   [ ] Access Control with Role & Permissions

```bash
laravel new todo --git --jet --stack=livewire
```

```bash
php artisan make:model Task -m -f -s
```

Setup migration, factory and seeder.

```bash
php artisan migrate
php artisan db:seed --class=TaskSeeder
```

To refresh db, run:

```bash
php artisan migrate:fresh
```

## Setup

For MacOS, put this in `~/.zsrch`:

```plaintext
export PATH=$PATH:$HOME/.composer/vendor/bin
```

Install the Laravel Installer

```bash
composer global require laravel/installer
```

Create new Laravel project.

```bash
laravel new training
```

## Debugging

Install following package:

```bash
composer require barryvdh/laravel-debugbar --dev
```

> In production, do turn off the `APP_DEBUG` in `.env` file.

## Authentication Log

```bash
composer require yadahan/laravel-authentication-log
php artisan vendor:publish --provider="Yadahan\AuthenticationLog\AuthenticationLogServiceProvider"
php artisan migrate
```

Add trait to `app\Models\User` class:

```php
use Yadahan\AuthenticationLog\AuthenticationLogable;

class User extends Authenticatable
{
    use AuthenticationLogable;
```

## Laravel Auditing

```bash
composer require owen-it/laravel-auditing
```

```bash
php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="migrations"
```

```bash
php artisan migrate
```

Setup the model you want to audit:

```php
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable as AuditableTrait;
class Task extends Model implements AuditableContract
{
    use AuditableTrait;
    use HasFactory;
```

## Laravel Permission

```bash
composer require spatie/laravel-permission
```

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

```bash
php artisan migrate
```

Setup `app\Models\User` to use `Spatie\Permission\Traits\HasRoles` trait:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use AuthenticationLogable;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
```

Setup seeder accordingly as `database/seeders/PermissionSeeder.php` then run:

```bash
php artisan db:seed --class=PermissionSeeder
```

Update `app/Policies/TaskPolicy.php` according and you are good to go.

## Using Sanctum to Authenticate a Mobile App

https://laravel-news.com/using-sanctum-to-authenticate-a-mobile-app

## References

-   <https://carbon.nesbot.com/>
