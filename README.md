# Test technique - Fabien Fernandez

## Installation

Development environment requirements :
- [Docker](https://www.docker.com) >= 17.06 CE
- [Docker Compose](https://docs.docker.com/compose/install/)

Setting up your development environment on your local machine :
```
$ git clone https://github.com/fernandez-fabien/laravel-import-csv.git
$ cd laravel-import-csv
$ cp .env.example .env
$ docker-compose run --rm --no-deps test-server composer install
$ docker-compose run --rm --no-deps test-server php artisan key:generate
$ docker run --rm -it -v $(pwd):/app -w /app node npm install
$ docker-compose up -d
```

Now you can access the application via [http://localhost:8000](http://localhost:8000).

**There is no need to run ```php artisan serve```. PHP is already running in a dedicated container.**

## Before starting
You need to run the migrations with the seeds :
```
$ docker-compose run --rm blog-server php artisan migrate --seed
```

And then, compile the assets :
```
$ docker run --rm -it -v $(pwd):/app -w /app node npm run dev
```

## Using the application
If the csv you want to import is not to big you can go on localhost:8000/csv and upload your file by the form

Else, you can use command line. First you need to put your file in the repository  /storage/app/files .
After that you can use the command line below ith the name of your file (to import asynchronously)
```
$ docker-compose run --rm test-server php artisan import:dataMobileCsv files/<filename.csv>
```

## Useful commands

Seeding the database :
```
$ docker-compose run --rm blog-server php artisan db:seed
```
