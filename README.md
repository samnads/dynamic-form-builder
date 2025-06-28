
## 🖥 Local Setup Instructions

Follow the steps below to run this project on your local machine.


```bash
git clone https://github.com/samnads/dynamic-form-builder.git
cd dynamic-form-builder
```

```bash
composer install

php artisan key:generate
```
Run Migrations and Seeders
```bash
php artisan migrate --seed
```
To process queued jobs like form submission emails:
```bash
php artisan queue:work
```