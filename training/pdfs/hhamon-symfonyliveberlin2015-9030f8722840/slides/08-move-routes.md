#### Step 8 - Move routes
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Move all the routing configuration from the bundle into
   the main routing file.

B) Delete the `routing.yml` in AppBundle.

**GOAL**
The site still works! Keeping your configuration in `app/config` makes your
code smaller. All configuration is in one spot.
