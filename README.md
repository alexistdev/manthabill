# ManthabillV2

ManthabillV2 is a billing/invoice management software for Hosting providers or those running a Hosting business. This software is free to use, but please maintain the copyright links.

## Tech Stack

- **Framework:** Laravel 11
- **PHP Version:** 8.2
- **Database:** MySQL 1.8
- **Template:** Upcube
- **Frontend:** Blade, Bootstrap 5
- **Package Manager:** NPM

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

## Installation

1. Clone the repository:
```
git clone -b development https://github.com/alexistdev/manthabill.git
```
2. Navigate to project directory:
```
cd manthabill_v2	
```
3. Install dependencies:
```
composer install
```
4. Build assets:
```
npm run build
```
5. Configure application:
   - Copy `.env.example` to `.env`
   - Create an empty database named `manthabill`
   - Update database configuration in `.env` file
6. Generate application key:
```
php artisan key:generate
```
7. Run database migrations:
```
php artisan migrate:fresh --seed
```
8. Start the application:
```
php artisan serve
```
## Support

Need help? You can:
- Email: alexistdev@gmail.com
- Open an [Issue on GitHub](https://github.com/alexistdev/manthabill/issues)

