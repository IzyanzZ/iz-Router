# iz-Router

Izyanz Router

There is an example's :

```php
<?php

use Iz\Router\Router;

require_once "vendor/autoload.php";

Router::get("/", function() {
  echo "Hello, World!";
});
```

### Router Method

##### o Get

Examples : 

```php
Router::get("/", function() {
  echo "Example";
});
```

##### o Post

Examples : 

```php
Router::post("/", function() {
  echo "Example";
});
```

# Author

[My Github](https://github.com/IzyanzZ)
