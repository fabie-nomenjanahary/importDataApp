1- .env file:set up the database configuration for the project

2-Command line: move to the project directory
//create the database specified in the config file (.env)
    php bin/console doctrine:database:create
//make a migration: generate sql for the required tables
    php bin/console make:migration
//run the sql which will create tables with all their properties
    php bin/console doctrine:migrations:migrate
3-Nb: datatable translation plugin is online so internet connection is needed