# Laravel PDF Printer

This is a Laravel application that demonstrates how to design a page and include a button to print the page as a PDF using Laravel DomPDF.

## Features

-   Design a web page with Laravel Blade templates
-   Include a button to print the page as a PDF
-   Use Laravel DomPDF for PDF generation

## Requirements

-   PHP >= 7.4
-   Composer
-   Laravel >= 8.0

## Installation

1. Clone the repository:

    ```sh
    git clone https://github.com/alifur-rahman/ordine-laravel/
    ```

2. Navigate to the project directory:

    ```sh
    cd laravel-pdf-printer
    ```

3. Install the dependencies:

    ```sh
    composer install
    ```

4. Copy the `.env.example` file to `.env`:

    ```sh
    cp .env.example .env
    ```

5. Generate the application key:

    ```sh
    php artisan key:generate
    ```

6. Set up your database in the `.env` file:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

7. Run the migrations:

    ```sh
    php artisan migrate
    ```

8. Install Laravel DomPDF:

    ```sh
    composer require barryvdh/laravel-dompdf
    ```

9. Publish the configuration file:
    ```sh
    php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
    ```

## Usage

1. Create a route to display the page and another to generate the PDF:

    ```php
    // routes/web.php

    Route::get('/page', [App\Http\Controllers\PageController::class, 'showPage'])->name('showPage');
    Route::get('/page/pdf', [App\Http\Controllers\PageController::class, 'generatePDF'])->name('generatePDF');
    ```

2. Create a controller to handle the logic:

    ```php
    // app/Http/Controllers/PageController.php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use PDF;

    class PageController extends Controller
    {
        public function showPage()
        {
            return view('page');
        }

        public function generatePDF()
        {
            $data = []; // Add data if needed
            $pdf = PDF::loadView('page', $data);
            return $pdf->download('page.pdf');
        }
    }
    ```

3. Create the Blade view:

    ```blade
    <!-- resources/views/page.blade.php -->

    <!DOCTYPE html>
    <html>
    <head>
        <title>Page Title</title>
    </head>
    <body>
        <h1>This is the page you want to print as PDF</h1>
        <p>Here you can add more content.</p>
        <a href="{{ route('generatePDF') }}" class="btn btn-primary">Print as PDF</a>
    </body>
    </html>
    ```

4. Serve the application:

    ```sh
    php artisan serve
    ```

5. Visit `http://localhost:8000/page` to see the page with the "Print as PDF" button.

## Contributing

Feel free to submit issues or pull requests.

## License

This project is licensed under the MIT License.
