<?php
define('ROOT_DIR', dirname(__FILE__));
require ROOT_DIR . '/vendor/autoload.php';

// Configure Maestrano API using the dev-platform, using the environment variables
// If you wish to use a file dev-platform.json use this syntax
// Maestrano::autoConfigure(ROOT_DIR.'/dev-platform.json');
Maestrano::autoConfigure();
