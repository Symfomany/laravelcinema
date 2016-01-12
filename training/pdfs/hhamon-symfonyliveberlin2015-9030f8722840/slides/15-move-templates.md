#### Step 15 - Move templates
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Move the contents of `AppBundle/Resources/views`
into `app/Resources/views`

B) Update all of your code for the new template locations:

    return $this->render('Blog/show.html.twig', array(

**GOAL**
The site still works! Why keep some templates in the bundle and
others in `app/Resources/views`? But everything in `app`. Simplify.

**EXTRA CREDIT**

Override the `error.html.twig` and `error404.html.twig`
templates, which also will live in `app/Resources/views`.

To help test the templates, go to /_error/500 and /_error/404
