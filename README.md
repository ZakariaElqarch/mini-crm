# Mini-CRM Project

This README provides instructions on how to set up and run the Mini-CRM project.

## Prerequisites

-   PHP: ^8.1
-   npm: ^10.8.1

## Installation and Setup

1. Clone the repository:

    ```
    git clone https://github.com/ZakariaElqarch/mini-crm.git
    ```

2. Install PHP dependencies:

    ```
    composer install
    ```

3. Install JavaScript dependencies:

    ```
    npm install
    ```

4. Copy the example environment file:

    - Windows

    ```
    copy .env.example .env
    ```

    - Linux or mac

    ```
    cp .env.example .env
    ```

5. Configure the database in the `.env` file:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mini_crm
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

6. Configure your smtp or Configure Mailtrap:

    - Create an account on Mailtrap
    - Go to Email Testing
    - Add a new inbox and give it a name
    - Go to settings
    - Choose laravel 9+
    - Copy your Mailtrap credentials
    - Update the `.env` file with your Mailtrap credentials

    ```
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_username
    MAIL_PASSWORD=upir_password
    ```

7. Run database migrations:

    ```
    php artisan migrate
    ```
   * Choose yes to create a db
8. Seed the database:

    ```
    php artisan db:seed
    ```

9. Generate application key:
    ```
    php artisan key:generate
    ```

## Running the Application

1. Start the Laravel development server:

    ```
    php artisan serve
    ```

2. In a separate terminal, compile and watch for asset changes:
    ```
    npm run dev
    ```

Now you should be able to access the application at `http://localhost:8000` (or the URL provided by the `artisan serve` command).
