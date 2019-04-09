<?php

use VanillaPHP\Helpers\AuthManager;

session_start();
require __DIR__ . '/../inc/bootstrap.php';

AuthManager::logout();
