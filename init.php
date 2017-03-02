<?php
define('ROOT_DIR', dirname(__FILE__));
require ROOT_DIR . '/vendor/autoload.php';

// Configure Maestrano API using the dev-platform
Maestrano::autoConfigure();
