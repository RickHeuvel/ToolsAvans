# ToolHub

| Stage         | Hosting       | Travis        |
| ------------- | ------------- | ------------- |
| Production    | [toolhub.herokuapp.com](http://toolhub.herokuapp.com) | [![Build Status](https://travis-ci.com/Peter-JanGootzen/ToolHub.svg?token=gKkRerZGe1KXx3pyWUTq&branch=master)](https://travis-ci.com/Peter-JanGootzen/ToolHub) |
| Development   | [toolhub-dev.herokuapp.com](http://toolhub-dev.herokuapp.com) | [![Build Status](https://travis-ci.com/Peter-JanGootzen/ToolHub.svg?token=gKkRerZGe1KXx3pyWUTq&branch=dev)](https://travis-ci.com/Peter-JanGootzen/ToolHub) |

## About ToolHub

ToolHub is a collection website for education tools used by [Avans Hogeschool](http://www.avans.nl/).

## ToolHub Wiki

The [ToolHub](https://github.com/Peter-JanGootzen/ToolHub/wiki) contains further technical information about the project.

| Page       | Description |
| ------------- | ------------- |
| [Coding guidelines](https://github.com/Peter-JanGootzen/ToolHub/wiki/Coding-Guidelines) | Further information about our coding standards  |
| [Version Control](https://github.com/Peter-JanGootzen/ToolHub/wiki/Version-Control)  | Contains information about how we devide our branches and our git workflow  |

## Getting Started

The instructions below will give you common information about how to setup your development environment.

### Prerequisites

* [Composer Dependency Manager](https://getcomposer.org/)
* [Laravel](https://laravel.com/docs/5.6#installation)

### Setup

```
[Clone the repo]
[Create a database named "toolhub" in your local mysql server]
cp .env.local .env
[Change the DB_USERNAME and DB_PASSWORD in .env to your mysql login credentials]
npm install
composer install
php artisan migrate:fresh --seed
```

## Authors

* **Martijn van de Wetering**
* **Peter-Jan Gootzen**
* **Bram-Boris Meerlo**
* **Koen van der Hulst**
* **Rick van den Heuvel**
* **Jan Schollaert**
* **Tim van Kessel**
* **Tom Paans**

## License

No license applied
