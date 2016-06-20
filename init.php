<?php
define('ROOT_DIR',dirname(__FILE__));
require ROOT_DIR . '/vendor/autoload.php';

// Configure Maestrano API using the dev-platform
Maestrano::autoConfigure(ROOT_DIR . "/dev-platform.json");
Maestrano::with('maestrano')->configure(ROOT_DIR . "/maestrano.json");