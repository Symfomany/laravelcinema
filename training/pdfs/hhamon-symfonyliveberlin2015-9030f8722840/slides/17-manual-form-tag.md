#### Step 17 - Manual Form Tag
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Remove form_start and form_end in `Comment/_form.html.twig`
and just render these manually.

Hint: You can see what variables the template has
by running {{ dump(_context|keys) }}

B) Remove the `action` option in `CommentController::createCommentForm`
it's not needed!

**GOAL**
The site still works! The `form_start` and `form_end` are ok,
but don't add much and just make forms look more obtuse.

**EXTRA CREDIT**

Use the new `bootstrap_3_layout.html.twig` built-in
form theme to style all your forms using bootstrap logic.

Also, render the fields individually using `form_row.html.twig`.
