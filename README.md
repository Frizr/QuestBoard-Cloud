# QuestBoard

**Level Up Your Productivity**

QuestBoard is a cloud-ready Laravel task management application with RPG gamification. Users can turn daily tasks, goals, responsibilities, and work into quests. Each quest has a category, difficulty, deadline, status, and EXP reward. Completing quests increases user EXP and level.

## Features

- Laravel Breeze authentication.
- Dark modern RPG landing page.
- User dashboard with quest statistics.
- Category CRUD.
- Quest CRUD with detail page.
- Quest search, filter, and sorting.
- Difficulty badges and status badges.
- Overdue badge without storing `overdue` as a database status.
- EXP reward calculation.
- Level progress bar.
- Leaderboard top 10 users by EXP.
- Authorization so users only manage their own categories and quests.
- Responsive Blade + Tailwind CSS UI.

## Tech Stack

- Laravel 13
- Laravel Breeze
- Blade templates
- Tailwind CSS
- Vite
- Eloquent ORM
- MySQL for Laragon/AWS
- Composer
- npm

## Local Setup Using Laragon

1. Put the project inside Laragon `www` directory, for example:

   ```text
   C:\laragon\www\QuestBoard
   ```

2. Open Laragon.

3. Start Apache and MySQL.

4. Open Laragon Terminal and enter the project folder:

   ```bash
   cd C:\laragon\www\QuestBoard
   ```

5. Install PHP dependencies:

   ```bash
   composer install
   ```

6. Install frontend dependencies:

   ```bash
   npm install
   ```

7. Copy environment file:

   ```bash
   copy .env.example .env
   ```

8. Create a MySQL database named:

   ```text
   questboard
   ```

   You can create it from Laragon database tools, phpMyAdmin, or MySQL CLI.

9. Configure `.env`:

   ```env
   APP_NAME=QuestBoard
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://questboard.test

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=questboard
   DB_USERNAME=root
   DB_PASSWORD=
   ```

10. Generate app key:

    ```bash
    php artisan key:generate
    ```

11. Run migration and seeder:

    ```bash
    php artisan migrate --seed
    ```

12. Run Vite dev server:

    ```bash
    npm run dev
    ```

13. Run Laravel development server:

    ```bash
    php artisan serve
    ```

    Or access the app through Laragon virtual host:

    ```text
    http://questboard.test
    ```

## Database Setup

QuestBoard is designed to run with MySQL in Laragon and AWS EC2.

Main tables:

- `users`
- `categories`
- `quests`
- `sessions`
- `cache`
- `jobs`
- `migrations`

The `users` table includes:

- `total_exp`
- `level`

The `quests` table includes:

- `user_id`
- `category_id`
- `title`
- `description`
- `difficulty`
- `status`
- `reward_exp`
- `deadline`
- `completed_at`

## Migration and Seeder

Run:

```bash
php artisan migrate --seed
```

The seeder creates:

- Demo user.
- Default categories.
- Sample quests with different difficulties and statuses.

## Default Demo Account

```text
Email: demo@questboard.test
Password: password
```

## AWS EC2 Deployment Notes

General deployment flow:

1. Create an AWS EC2 Ubuntu Server instance.
2. Open ports `22`, `80`, and optionally `443` in Security Group.
3. SSH into the server.
4. Install Apache, PHP, MySQL, Composer, Git, and Node.js.
5. Clone project into:

   ```bash
   /var/www/questboard
   ```

6. Configure production `.env` database settings.

7. Install optimized PHP dependencies:

   ```bash
   composer install --optimize-autoloader --no-dev
   ```

8. Generate app key:

   ```bash
   php artisan key:generate
   ```

9. Run migration and seeder:

   ```bash
   php artisan migrate --seed --force
   ```

10. Build frontend assets:

    ```bash
    npm install
    npm run build
    ```

11. Set permissions:

    ```bash
    sudo chown -R www-data:www-data /var/www/questboard
    sudo chmod -R 775 /var/www/questboard/storage /var/www/questboard/bootstrap/cache
    ```

12. Configure Apache VirtualHost to point to:

    ```text
    /var/www/questboard/public
    ```

13. Enable Apache rewrite module:

    ```bash
    sudo a2enmod rewrite
    ```

14. Restart Apache:

    ```bash
    sudo systemctl restart apache2
    ```

15. Cache production config:

    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

16. Access app using EC2 public IP or configured domain.

## Firewall Notes

For Ubuntu UFW:

```bash
sudo ufw allow OpenSSH
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable
sudo ufw status
```

For AWS Security Group, allow:

| Port | Purpose |
|---|---|
| 22 | SSH |
| 80 | HTTP |
| 443 | HTTPS |

## Screenshots

Screenshots can be added here:

- Landing page screenshot.
- Login page screenshot.
- Dashboard screenshot.
- Quest list screenshot.
- Quest detail screenshot.
- Category management screenshot.
- Leaderboard screenshot.

## Useful Commands

Run tests:

```bash
php artisan test
```

Clear cache:

```bash
php artisan optimize:clear
```

Build assets:

```bash
npm run build
```

Run local server:

```bash
php artisan serve
```
