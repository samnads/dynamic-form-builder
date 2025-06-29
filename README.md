
## Local Setup Instructions

Follow the steps below to run this project on your local machine.


```bash
git clone https://github.com/samnads/dynamic-form-builder.git
```
```bash
cd dynamic-form-builder
```
```bash
composer install
```
## Update database credentials in .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dynamic_form_builder
DB_USERNAME=-YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD
```
## Migrate and Seed database
```bash
php artisan migrate
```
```bash
php artisan db:seed
```
## Run the application
```bash
php artisan serve
```
## Login Credentials
```
Username : admin@example.com
Password : 12345
```
To process queued jobs (form submission)
```bash
php artisan queue:work
```