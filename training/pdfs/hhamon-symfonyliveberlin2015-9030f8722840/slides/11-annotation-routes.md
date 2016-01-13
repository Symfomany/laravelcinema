#### Step 11 - Annotation Routes
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Tell Symfony to import annotation routes from AppBundle

Source: SensionFrameworkExtraBundle documentation

B) Delete the `homepage` and "blog show" route from `routing.yml`

C) Add a new @Route annotation to `PageController::indexActon`
and `BlogController::showAction` to replace these routes.

**GOAL**
The site still works! Annotation routes mean less files and more
things in the same spot.

**EXTRA CREDIT**

Move *all* of your routes into annotations. While you're at it, make
some respond to only GET methods.
