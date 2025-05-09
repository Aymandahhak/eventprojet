# Event Management System

A Laravel-based event management system that allows users to create, manage, and register for events.

## Features

- User roles: Admin, Organizer, and Participant
- Event management (create, edit, delete)
- Event registration with payment processing
- User profile management
- Dashboard for each user role
- Responsive design

## Requirements

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM
- Stripe account for payment processing

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd event-management
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create a copy of the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in the `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_management
DB_USERNAME=root
DB_PASSWORD=
```

7. Configure Stripe in the `.env` file:
```
STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key
STRIPE_WEBHOOK_SECRET=your_stripe_webhook_secret
```

8. Run database migrations and seeders:
```bash
php artisan migrate --seed
```

9. Create storage link:
```bash
php artisan storage:link
```

10. Compile assets:
```bash
npm run dev
```

11. Start the development server:
```bash
php artisan serve
```

## Default Admin Account

After running the seeders, you can log in with the following credentials:

- Email: admin@example.com
- Password: password

## Usage

1. Log in as an admin to manage users and events
2. Create an organizer account to create and manage events
3. Create a participant account to register for events
4. Use the dashboard to manage your events and registrations

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License.
