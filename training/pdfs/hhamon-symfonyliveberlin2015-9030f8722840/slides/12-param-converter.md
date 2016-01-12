#### Step 12 - Param Converter
Stuck? No worries: http://bit.ly/fabien-best-practices

A) In `BlogController::showAction`, change the `$id`
argument to `Post $post` and add a `use` statement
for the `Post` class.

**GOAL**
The site still works! What!? Doctrine automatically
queries for your object.

**EXTRA CREDIT**

Make the same updates to `CommentController::_newFormAction`
and `CommentController::newAction`
