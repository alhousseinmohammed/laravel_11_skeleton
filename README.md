# Laravel 11 Project

This is a sample Laravel 11 project. It provides a robust framework for web application development with a focus on simplicity and speed. This README will guide you through the setup and usage of this project.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Running the Project](#running-the-project)
  - [With Docker Compose](#with-docker-compose)
  - [With Nginx](#with-nginx)
  - [Directly on Localhost](#directly-on-localhost)
- [Database Setup](#database-setup)
  - [Migration](#migration)
  - [Seeding](#seeding)
- [Running Tests](#running-tests)
- [Contributing](#contributing)
- [License](#license)

## Requirements

- PHP >= 8.1
- Composer
- MySQL or PostgreSQL
- Docker (optional)
- Nginx (optional)

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/laravel11-project.git
   cd laravel11-project
2. Install dependencies:

   ```bash
   composer install
3. Copy the `.env.example` file to `.env` and configure your environment variables:

   ```bash
   cp .env.example .env
   php artisan key:generate

## Running the Project

### With Docker Compose

1. Ensure Docker and Docker Compose are installed on your system.
2. Build and run the containers:

   ```bash
   docker-compose up -d

The application will be accessible at `http://localhost`.

### With Nginx

1. Ensure Nginx is installed on your system.
2. Configure Nginx with the following server block:

   ```nginx
   server {
       listen 80;
       server_name your-domain.com;

       root /path/to/laravel11-project/public;

       index index.php index.html;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
           fastcgi_index index.php;
           include fastcgi_params;
           fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
           fastcgi_param PATH_INFO $fastcgi_path_info;
       }

       location ~ /\.ht {
           deny all;
       }
   }
#### Restart Nginx:

    ```bash
    sudo systemctl restart nginx

The application will be accessible at `http://your-domain.com`.

### Directly on Localhost

1. Serve the application using the built-in Laravel server:

   ```bash
   php artisan serve

The application will be accessible at http://localhost:8000.

## Database Setup
### Migration
To run the database migrations, execute:

bash

    ```bash
    php artisan migrate

### Seeding
To seed the database with sample data, execute:

    ```bash
    php artisan db:seed

## Running Tests
To run the tests, execute:

    ```bash
    php artisan test

## Contributing
Thank you for considering contributing to this project! Please fork the repository and create a pull request with your changes.


