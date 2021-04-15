<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter as Router;

require_once 'helpers.php';
require_once 'routes.php';


// Start the routing
Router::start();