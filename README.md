# Travel-Demo

![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)
![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)
![License](https://img.shields.io/packagist/l/laravel/framework)

## About Travel-Demo

Travel-Demo is a web application designed to help users book hotels and rooms. It is built using the Laravel framework, which is known for its elegant syntax and powerful features.

## Features

- Hotel and room booking
- Multi-language support (Arabic and English)
- Dynamic breadcrumb navigation
- User-friendly interface

## Requirements
Before you begin, ensure you have the following installed on your system:
- PHP 8.3+
- Laravel v10.0+
- Livewire v3.0+
- Composer (dependency management)
- MySQL or PostgreSQL (or another supported database , I advise PostgreSQL)
- npm or yarn
- Filament v3+
- Tailwind v4+

## Installation

To get started with Travel-Demo, follow these steps:

1. Clone the repository:
    ```sh
    git clone https://github.com/AmenArbia/travel-app.git
    ```

2. Navigate to the project directory:
    ```sh
    cd travel-app
    ```

3. Install the dependencies:
    ```sh
    composer install
    npm install
    ```

4.  Update the [.env] file in your application with your database configuration:
    ```env
    DB_CONNECTION=*your database*
    DB_HOST=127.0.0.1
    DB_PORT=*your port*
    DB_DATABASE=*name of your database*
    DB_USERNAME=*username* 
    DB_PASSWORD=*password*
    ```

5. Build the application for production:
    ```sh
    npm run build
    ```
6. Serve the application in development mode:
    ```sh
    npm run dev
    ```

7. Start the development server:
    ```sh
    php artisan serve
    ```

## Usage

Once the development server is running, you can access the application at `http://localhost:8000`. You can navigate through the application to book hotels and rooms, and switch between Arabic and English languages.

## Documentation

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
