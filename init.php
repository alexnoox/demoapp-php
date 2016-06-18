<?php
define('ROOT_DIR',dirname(__FILE__));
require ROOT_DIR . '/vendor/autoload.php';

// Configure Maestrano API
Maestrano::configure(ROOT_DIR . "/maestrano.json");

echo "Maestrano::fetchEndpointsConfig", Maestrano::fetchEndpointsConfig();