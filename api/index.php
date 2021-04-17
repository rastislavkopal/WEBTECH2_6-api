<?php
require __DIR__ . '/vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter as Router;

require_once 'helpers.php';
require_once 'routes.php';


// Start the routing
Router::start();