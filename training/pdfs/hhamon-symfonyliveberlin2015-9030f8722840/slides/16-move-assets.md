#### Step 16 - Move Assets
Stuck? No worries: http://bit.ly/fabien-best-practices

A) Move `AppBundle/Resources/public/css`
to `web/css`

B) Update `base.html.twig` to import each CSS file manually
from this new location

**GOAL**
The site still works! There's no advantage to hiding your
public assets deep inside your bundles.

**EXTRA CREDIT**

Use bower to download Bootstrap into web/assets/vendor and then
include this in `base.html.twig`.
