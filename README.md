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
- Comprehensive video tutorials and documentation

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

4. Copy the [.env.example](http://_vscodecontentref_/1) file to [.env](http://_vscodecontentref_/2) and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

5. Generate the application key:
    ```sh
    php artisan key:generate
    ```

6. Run the database migrations:
    ```sh
    php artisan migrate
    ```

7. Seed the database with initial data:
    ```sh
    php artisan db:seed
    ```

8. Start the development server:
    ```sh
    php artisan serve
    ```

## Usage

Once the development server is running, you can access the application at `http://localhost:8000`. You can navigate through the application to book hotels and rooms, and switch between Arabic and English languages.

## Documentation

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to Travel-Demo! If you would like to contribute, please fork the repository and submit a pull request.

## License

Travel-Demo is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
