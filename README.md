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
    ```sh
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



## Database seeding 
You may populate the database to help you get started quickly by running the database seeder. Default login information :
**Note** Default admin user:  email: admin@gmail.com password: admin

    Create new user : 
    ```sh
        php artisan make:user
    ```

Run the database seeder 
    php artisan db:seed
    
It's recommended to have a clean database before seeding . You can reset your database to a clean state at any point by runng the follwing commend : 
    
    php artisan migrate:fresh
**Note:** After seeding the database and acces to the admin panel , you'll need to:
1. Add amenities to the hotels (WiFi, Parking, Bedroom ,etc.)
2. Upload hotel and room photos
3. Assign rooms to hotels

These steps are necessary to experience the full booking functionality and view detailed hotel information in the frontend.

## Usage

Once the development server is running, you can access the application at `http://localhost:8000`. You can navigate through the application to book hotels and rooms, and switch between Arabic and English languages.

