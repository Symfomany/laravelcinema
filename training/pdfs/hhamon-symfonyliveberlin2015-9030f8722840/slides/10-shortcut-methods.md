#### Step 10 - Controller Shortcuts
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Symfony 2.6 comes with new controller shortcut methods:

* redirectToRoute()
* addFlash()
* isGranted()
* denyAccessUnlessGranted()
* isCsrfTokenValid()

Use `redirectToRoute` and `addFlash` in `PageController` to
simplify things.

**GOAL**
The site still works! Controller shortcut methods are awesome :).

**EXTRA CREDIT**

Create your own base Controller class with a `getBlogRepository`
method, extend this class, and use this shortcut. What other
shortcuts would be useful?
