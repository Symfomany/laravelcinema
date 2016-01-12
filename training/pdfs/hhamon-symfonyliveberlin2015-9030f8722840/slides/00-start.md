#### Welcome to Fabien's Symfony Best Practices

MAKE SURE YOU'RE ALL SETUP!!!!!

A) Unzip the code... anywhere!

B) Open a terminal and move into the project directory

C) Make sure your system is ready to go!

    php app/check.php

D) Initialize the database

    php app/console doctrine:database:create
    php app/console doctrine:schema:create
    php app/console doctrine:fixtures:load

E) Start up the built-in PHP web server

    php app/console server:start

** If you are using PHP 5.3, you'll need to configure
   your web server! But lame, PHP 5.3 is ancient! Come on!?

F) Pull things up in your browser!

    http://localhost:8000

G) Say "Hi" to your neighbor :)
