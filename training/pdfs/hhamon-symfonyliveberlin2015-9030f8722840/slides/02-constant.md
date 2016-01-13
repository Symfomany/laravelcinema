#### Step 2 - Constants versus Parameters!
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Open up src/AppBundle/Controller/PageController.php and find where
    the `blogger_blog.comments.latest_comment_limit` is being used.

B) Remove this parameter. Instead, just create a new constant on the
    `Blog` entity called `LATEST_COMMENT_LIMIT` and use that instead.

**GOAL**
The site still works, but we've removed an extra piece of configuration,
which didn't really need to be configurable...

