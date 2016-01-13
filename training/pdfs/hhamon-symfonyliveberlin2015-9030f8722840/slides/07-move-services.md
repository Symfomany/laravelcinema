#### Step 7 - Move services
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Create a new `app/config/services.yml` and move all the service
   configuration from the bundle into this file.

B) Delete the `services.yml` in AppBundle.

**GOAL**
The site still works! Keeping your configuration in `app/config` makes your
code smaller. All configuration is in one spot.

