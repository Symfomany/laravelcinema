Introduction to Design Patterns
===============================

Please find the code of the four studied design pattern during my tutorial at
php[tek] conference. Please, provide feedback on Joind.in too!

Composite
---------

* The **Form** Component
* The **Shop/Combo** Component
* The **Navigation** Component

Decorator
---------

* The **Pizza** Component
* The **Writer** Component (Pen example)
* The **Shop/Discount** Component

Adapter
-------

* The **Templating** Component

Factory Method
--------------

* The **MediaGallery** Component
* The **DI** Component

See Also
--------

Installing dependencies with Composer:

    $ cd /path/to/this-directory
    $ composer.phar install

Running all the unit tests:

    $ ./vendor/bin/phpunit

Generating code coverage report:

    $ ./vendor/bin/phpunit --coverage-html ./coverage

All unit tests implementing the presented design patterns can be found under the
`Tests/` directory of each component under the `src/` directory.
