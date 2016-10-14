<?php

require_once __DIR__ . '/setup/setup.php';

$login = getPageBuilderClass('Login');

$actors = $login->getActorsTest();
echo(count($actors));

$login->renderTemplate('login.html');