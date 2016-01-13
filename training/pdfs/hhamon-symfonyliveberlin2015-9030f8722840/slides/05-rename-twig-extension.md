#### Step 5 - Twig Extension: Less Depth
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Move `AppBundle\Twig\Extensions\BloggerBlogExtension` simply to
   `AppBundle\Twig\AppExtension`

B) Update `services.yml` so things still work

**GOAL**
The site still works! But now we've removed unnecessary deep dirctory structures

**EXTRA CREDIT**

Also move the `BloggerBlogExtensionTest` and see if you can run the tests
and get them to pass!
