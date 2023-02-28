## Secure Transfer Project

> Version 0.0.1

Getting Stared With Laravel on macOS.

There are Two ways you can start your development:

+ Docker Desktop
+ Laravel Valet


[Laravel & Docker](#laravel-and-docker)
---------------------------------------

Laravel Sail is a light-weight command-line interface for interacting with Laravel's default Docker configuration. Sail provides a great starting point for building a Laravel application using PHP, MySQL, and Redis without requiring prior Docker experience.

Sail installation may take several minutes while Sail's application containers are built on your local machine.

```bash
cd your-application
```

do a composer install

```bash
composer install
```
then:

```bash
./vendor/bin/sail up
```

However, instead of repeatedly typing vendor/bin/sail to execute Sail commands, you may wish to configure a shell alias that allows you to execute Sail's commands more easily:

```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

To make sure this is always available, you may add this to your shell configuration file in your home directory, such as `~/.zshrc` or `~/.bashrc`, and then restart your shell.


[Starting & Stopping Sail](#starting-and-stopping-sail)
-------------------------------------------------------

Laravel Sail's `docker-compose.yml` file defines a variety of Docker containers that work together to help you build Laravel applications. Each of these containers is an entry within the `services` configuration of your `docker-compose.yml` file. The `laravel.test` container is the primary application container that will be serving your application.

Before starting Sail, you should ensure that no other web servers or databases are running on your local computer. To start all of the Docker containers defined in your application's `docker-compose.yml` file, you should execute the `up` command:

```bash
sail up
```

To start all the Docker containers in the background, you may start Sail in "detached" mode:

```bash
sail up -d
```

Once the application's containers have been started, you may access the project in your web browser at: [http://localhost](http://localhost).

To stop all the containers, you may simply press Control + C to stop the container's execution. Or, if the containers are running in the background, you may use the `stop` command:

```bash
sail stop
```

Next Step is to access the running container and preparing our project environment

## Setup Environment

```bash
cp .env.example .env
```
Make sure your environment variables are reflecting in `docker-composer.yml`

```dotenv
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Now that your database hase been set up via docker container you may run:

```bash
sail artisan migrate
```
to populate tables and scheme's of your database. And now optionally populate
it with data:

```bash
sail artisan db:seed
```
Setup Application Encryption Key:

```bash
sail artisan key:generate
```
<<<<<<< Updated upstream

Now Install Project Dependencies

```bash
sail composer install
```

Once the application's Docker containers have been started, you can access the application in your web browser at: [http://localhost](http://localhost).
 

Whenever you do git pull in future always make sure to run these commands.

```bash
sail composer install
```

```bash
sail artisan migrate
```
=======
Once the application's Docker containers have been started, you can access the application in your web browser at: [http://localhost](http://localhost).
 
>>>>>>> Stashed changes
