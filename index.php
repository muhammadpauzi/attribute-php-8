<?php

use Core\App;

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/routes/api.php';

(new App)->run($apiRouter);

// var_dump($_SERVER);
// var_dump($_REQUEST);
