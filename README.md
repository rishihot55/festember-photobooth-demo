# Festember Photobooth (Demo)
A web based project which implements a photobooth system in HTML5 as well as a backend for uploading images

## Build Instructions
To setup the system, follow the given steps:
- Copy or rename the `.env.sample` file as `.env` and fill it up with your database and environment configuration
- Run `composer install` to install all laravel modules
- Run `php artisan migrate` to execute all migrations
- Run `php artisan db:seed` to seed the DB with sample data

## Running the server
To start the server, run `php artisan serve` to run the server in development mode. 
Otherwise, configure it to run on Apache/NGINX/HHVM using the public folder as DocumentRoot. 
Set up .htaccess appropriately to allow URL rewrites.

## Routes

- `GET /` - Frontend route containing a barebones HTML input accepting RFID card no.
- `GET /students` - Returns the list of students along with their roll no and RFID card no., etc.
- `POST /images` - Accepts a base64 encoded image and festember_id and stores the image in the storage folder.
- `GET /images` - Displays the festember ID as well as the filename of the image

## TODO
- Route to display the festember ID and the images in order to send to the Festember server.
