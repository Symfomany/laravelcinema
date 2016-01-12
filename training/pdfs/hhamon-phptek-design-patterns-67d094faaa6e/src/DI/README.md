The Service Container
=====================

The Service Container (or Service Locator) is a variant of the Factory Method
design pattern. It creates global objects (services) on demand and ensures
services are shared and reused when requested multiple times.

Usage
-----

    :::php
    <?php
    
    $dic = new DI\ServiceContainer();
    
    $mailer  = $dic->get('mailer');
    $logger  = $dic->get('logger');
    $factory = $dic->get('metadata_factory');

