### CSV import test task

**My local environment**
- PHP 7.4.18
- Node v14.17.0
- NPM 7.14.0
- MySQL Ver 8.0.25
- OS Ubuntu 20.04

**Installation and launch**
- git clone [repo_url]
- cp .env.example .env
- create new MySQL database
- fill DB_* section with your credentials
- composer install
- npm install
- php artisan key:generate
- php artisan migrate
- npm run development
- php artisan serve

