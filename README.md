
# LaravelCRM

## Prerequisites


- **PHP** (version 8.0 or higher)
- **Composer**
- **Node.js**
- **Git**
- **MySQL** (or configure another DB driver in the `.env`)


## Instructions


**Clone project**

 ```bash
git clone https://github.com/socyi/MiniCRM.git
```

**Navigate to the project directory**

```bash
cd MiniCRM
```

**Install PHP dependencies**
 ```bash
composer install
 ```

**Modify .env file with database driver, name, username, password**
 ```bash
.env
 ```

**Generate Application Key**
 ```bash
php artisan key:generate
 ```

**Run migrations**
 ```bash
php artisan migrate
 ```

**Populate the database with initial data**
 ```bash
php artisan db:seed
 ```


**Install JavaScript dependencies**
 ```bash
npm install
 ```

**Compile front-end assets**
 ```bash
npm run dev
 ```

**Start the development server**
 ```bash
php artisan serve
 ```

**Access the application by navigating to the following URL in your web browser:**


http://localhost:8000/

**This link will redirect you to the login page, where you can enter your credentials to access the Mini CRM application.**
