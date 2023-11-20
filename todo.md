# Training at UMPSA

## Project

During this course, a project called Task Management will be used as a requirement for building an application with Laravel framework.

Task Management System will have:

- [x] Tasks CRUD
    - [x] Migration
      - [x] title
      - [x] status
      - [x] owner of task
    - [x] Factory
    - [x] Seeder
    - [x] Model

- [x] Authentication
- [ ] Authorization
- [ ] Access Control with Role & Permissions

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
