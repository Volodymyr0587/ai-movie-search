# AI MOVIE SERIAL SEARCH

#### Using GEMINI API and OMDB API

Just describe what you want to watch in a few words and get several options to choose from. Supports search in English and Ukrainian.

## Installation

### Prerequisites

PHP >= 8.2
Composer
Laravel
Node.js & npm

#### Steps

🧬 Clone the repository

`git clone https://github.com/Volodymyr0587/laravel-cinememo`

`cd ai-movie-search`

📦 Install dependencies

`composer install`

`npm install`

📝 Set up the environment

`cp .env.example .env`

`php artisan key:generate`

## Configuration

Set up your api key in .env:

```
GEMINI_API_KEY=your_key_here
OMDB_API_KEY=your_key_here
```

## Serve the Application

You can start the application in two ways:

- Option 1 — Run each service manually:

    ```
    npm run dev

    php artisan serve
    ```

- Option 2 — Use a single Composer command:
  `     composer run dev
    `
  This command will automatically start the Vite dev server and prepare the app for local development on localhost.
