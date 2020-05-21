# Blabber

[![GitHub issues](https://img.shields.io/github/issues/jmeriksson/blabber)](https://github.com/jmeriksson/blabber/issues)
[![GitHub license](https://img.shields.io/github/license/jmeriksson/blabber)](https://github.com/jmeriksson/blabber/blob/master/LICENSE)

Blabber is a social media platform for journalists and writers. Users (called "authors") can write articles, read other authors' articles, follow their favorite authors, and much more. Blabber is created as a school project for a Database Theory course (2DV513) at Linnaeus University. Feel free to use parts or all of this software in any way.

## Setting up

This section describes how you start using this application.

### Pre-requisites

The application requires that [Composer](https://getcomposer.org/), [Laravel](https://laravel.com/), [Node](https://nodejs.org/en/), [NPM](https://www.npmjs.com/), and [PHP (I recommend XAMPP, but other stacks may be used)](https://www.apachefriends.org/index.html) is installed on your computer, in order to run locally.

### Installation steps

1. Clone this repo.
2. Open a command line terminal and `CD` into the application directory.
3. Type `composer install` in the terminal and wait for the process to finish.
4. Type `npm install` in the terminal and wait for the process to finish.
5. Make a copy of the `.env.example` file and name it `.env` by typing `cp .env.example .env` in the terminal.
6. Generate an app ecryption key in the `.env` file by typing `php artisan key:generate` in the terminal.
7. Create an empty database for the application. Add the database information to the newly created `.env` file (this allows Laravel to connect to the database). The `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` entries in the `.env` file chould match the credentials of the database you created.
8. (Optional) Change the `APP_NAME` entry in the `.env` file from "Laravel" to "Blabber".
9. Import the `blabber_db_dump.sql` file into your database.
10. Make sure that localhost points to the `public` folder in the blabber directory. If you are using XAMPP, this can be changed in the `httpd.conf` file. You may also create a virtual host.
11. Open a browser and navigate to localhost. You should now see the Blabber start page and can start using the application. All users have the password '123456789'. For example, you can log in with username 'admin' and password '123456789'.
