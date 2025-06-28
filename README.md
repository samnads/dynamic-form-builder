
## 🖥 Local Setup Instructions

Follow the steps below to run this project on your local machine.


```bash
git clone https://github.com/samnads/dynamic-form-builder.git
cd dynamic-form-builder
```

```bash
composer install
```
```
Then edit the `.env` file and set your database credentials:
```
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```
Run Migrations and Seeders
```bash
php artisan migrate --seed
```
To process queued jobs like form submission emails:
```bash
php artisan queue:work
```