<?php

require_once __DIR__ . '/setup/setup.php';

$login = getPageBuilderClass('Login');

$login->renderTemplate('login.html');