
## User-Role-Permission-Module mapping system
## Project Destination
This project is use to Mapping the users with Role.Permission,Module
## Installation
Clone this repository
- composer install
- cp .env.example .env
- php artisan migrate
- php artisan key:generate
- php artisan serve

## Pre-Required Packages
- laravel/framework : 10.0
- php               : 8.1
- laravel/sanctum   : 3.2
## Develop  Functionalitys
- Mapping of User to Role
- Mapping of role to permission
- Mapping of permission to module 
# Postman Collection link
- User Mapping
- https://documenter.getpostman.com/view/25758945/2s93JnVmy7
