Installation Instructions:
1. Clone repo using git command `git clone https://github.com/sdon2/axiever-assessment.git`
2. Install composer dependencies using command `composer install`
3. Copy `.env.example` file in the root directory and save it as `.env`
4. Run command `php artisan key:generate` to set application key
5. SET following database credentials in the .env file according to your MySQL setup: `DB_CONNECTION, DB_HOST, DB_PORT, DB_USER, DB_PASSWORD, DB_DATABASE`
6. Run migrations and seeder using command `php artisan migrate --seed`
7. Run the application using command `php artisan serve`
8. That's all. Now you can login to the application using credentials `admin@example.com`, `salesperson@eample.com`.
