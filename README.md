# Travel-Demo

Travel-Demo is a web application designed to help users book hotels and rooms. It is built using the Laravel framework, which is known for its elegant syntax and powerful features.

## Features

- Hotel and room booking
- Multi-language support (Arabic and English)
- Dynamic breadcrumb navigation
- User-friendly interface

## Requirements
Before you begin, ensure you have the following installed on your system:
- PHP 8.3+
- Laravel v11+
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

3. Install the dependencies using composer and npm :
    ```sh
    composer install
    npm install
    ```

4. Copy the example env file and make the required configuration changes in the .env file : 
    ```sh
    cp .env.example .env
    ```
5.  Update the [.env] file in your application with your database configuration:
    ```env
    DB_CONNECTION="your database(pgsql Or mysql)"
    DB_HOST=127.0.0.1
    DB_PORT="your port"
    DB_DATABASE="name of your database"
    DB_USERNAME="your database username" 
    DB_PASSWORD="your database password"
    ```
6. Generate a new application key : 
    ```sh
   php artisan key:generate
    ```

7. Run the database migrations (Set the database connection in .env before migrating) 
    ```sh
   php artisan migrate
    ```

8. Build your assets & start the local development server : 
    ```sh
    npm run build
    npm run dev
    ```

9. Or start the development server in a new terminal :
    ```sh
    php artisan serve
    ```
10. Command list :
    ```sh
    git clone https://github.com/AmenArbia/travel-app.git
    cd travel-app
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    npm run build
    npm run dev
    php artisan serve
    ```

## Usage

Once the development server is running, you can access the application at `http://localhost:8000`. You can navigate through the application to book hotels and rooms, and switch between Arabic and English languages.

