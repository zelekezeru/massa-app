# My Laravel App

This is a Laravel application that utilizes Vue.js with Inertia.js for a modern single-page application experience. The project is designed to support dark mode and incorporates Spatie packages for enhanced functionality.

## Project Structure

- **app/**: Contains the core application logic, including models, controllers, and middleware.
- **bootstrap/**: Contains files for bootstrapping the application.
- **config/**: Contains configuration files for various services and settings.
- **database/**: Contains database migrations, factories, and seeders.
- **public/**: Contains the front-facing files, including the entry point for the application.
- **resources/**: 
  - **js/**: Contains Vue components and the bootstrap file for Inertia.js.
    - **App.vue**: The main Vue component.
    - **Pages/**: Contains Vue components for different pages.
      - **Home.vue**: The home page component.
    - **bootstrap.js**: Responsible for bootstrapping the Vue application.
  - **css/**: Contains CSS styles, including styles for dark mode.
    - **app.css**: Main CSS file.
  - **views/**: Contains Blade templates.
    - **welcome.blade.php**: The welcome page template.
- **routes/**: Contains web routes for the application.
  - **web.php**: Defines the routes for the application.
- **storage/**: Used for storing logs, cached files, and other data.
- **tests/**: Contains test files for the application.
- **composer.json**: Configuration file for PHP dependencies.
- **package.json**: Configuration file for JavaScript dependencies.
- **webpack.mix.js**: Configuration file for Laravel Mix.

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```
   cd my-laravel-app
   ```

3. Install PHP dependencies:
   ```
   composer install
   ```

4. Install JavaScript dependencies:
   ```
   npm install
   ```

5. Set up your environment file:
   ```
   cp .env.example .env
   ```

6. Generate the application key:
   ```
   php artisan key:generate
   ```

7. Run migrations:
   ```
   php artisan migrate
   ```

8. Start the development server:
   ```
   php artisan serve
   ```

## Usage

Visit `http://localhost:8000` in your browser to see the application in action. The application supports dark mode and is built with a focus on performance and user experience.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any enhancements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.