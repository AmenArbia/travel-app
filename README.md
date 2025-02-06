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

