#### Step 3 - No Dependency Injection Directory!
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Completely remove the `DependencyInjection` directory.

B) Import the the AppBundle `services.yml` directly from `app/config/config.yml`

**GOAL**
The site still works! But now we've removed the "DependencyInjection" files,
which are totally unnecessary.

