# ManthaBill

A hosting billing and management system built with Laravel 12.

## About

ManthaBill is a web-based billing platform for hosting providers. It handles customer registration, hosting/VPS/domain services, invoicing, payment confirmation, and support ticketing — all from a single admin-facing and customer-facing interface.

This project is a full rewrite of the original CodeIgniter 3 codebase to Laravel 12, maintaining full feature, UI, and database parity with the legacy system.

## Tech Stack

- **Framework:** Laravel 12
- **Language:** PHP 8.4
- **Database:** MySQL 8
- **Frontend:** Blade Templates, Tailwind CSS

## Features

- Customer registration & authentication
- Admin panel for managing clients, hosting, VPS, and domains
- TLD management and domain service configuration
- Invoice generation and payment confirmation flow
- Support ticket system
- Email notification system

## Requirements

- PHP 8.4+
- MySQL 8+
- Composer

## Getting Started

```bash
git clone <repo-url>
cd manthabill
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

## Project Structure

```
app/Http/Controllers/
├── Auth/          # Customer authentication
├── Admin/         # Admin panel controllers
├── Member/        # Customer dashboard
├── Domain/        # Domain management
├── Invoice/       # Invoice & payment
├── Product/       # Hosting packages
├── Service/       # Service management
├── Setting/       # System settings
└── Ticket/        # Support tickets
```

## License

Proprietary. All rights reserved.
