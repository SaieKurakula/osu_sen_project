<?php

require_once __DIR__ . '/setup/setup.php';



// What will go here is the main menu template.

// NOTE:: Base will never be called directly. This is just to test.
$base = getPageBuilderClass('Base');




$base->renderTemplate('base.html');
