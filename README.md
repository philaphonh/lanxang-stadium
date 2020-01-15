# Lan Xang Stadium

Football stadium reservation system built with Laravel + Vue + Tailwind

## About

This is an assigment of PHP 2 class at National University of Laos

## Setup

Install Laravel dependencies with Composer, a package manager for PHP

```bash
composer install
```

Install Vue and Tailwind dependencies with NPM or yarn

```bash
# NPM
npm install

# Yarn
yarn install
```

Build frontend app in production

```bash
# NPM
npm run prod

# Yarn
yarn prod
```

If you want to run in dev build, follow this command

```bash
# NPM
npm run watch

# Yarn
yarn watch
```

Serve backend app

```bash
php artisan serve #default port: 8000
```

## Further Note

This app still doesn't have Authentication as I just keep some credential in ```localStorage``` instead of generating token to authenticate APIs (JWT library provided by Tymon is not fully compatible with Laravel 6).

I have added Laravel Passport into the app but didn't implement, So you can do it yourself.
