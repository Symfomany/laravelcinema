#### Step 14 - Remove layout.html.twig
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Delete `layout.html.twig` in `AppBundle`

B) Make all templates extend `base.html.twig`

    {% extends 'base.html.twig' %}

**GOAL**
The site still works! There's no point in having an extra layer
for the templates. In some cases, you *may* need this for
different sections of your site, but we did not.

**EXTRA CREDIT**

Why don't we use `::base.html.twig`? Experiment with rendering
different template paths without the colons (`:`) to find out how
*not* using the colons works.
