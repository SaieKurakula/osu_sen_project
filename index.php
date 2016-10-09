<?php

require_once __DIR__ . '/setup/setup.php';


$loginRequired = request('loginRequired');
$loginSubmitted = request('loginSubmitted');

if ($loginRequired) {


   // NEED TO ADD LOGIN PAGEBUILDER CLASS
}
else if ($loginSubmitted) {

   // NEED TO ADD LOGIN VERIFICATION LOGIC (MAYBE PART OF THE LOGIN PAGEBUILDER CLASS)
   // Check to make sure login is accurrate. If not, re-render log-in form with errors
}


// What will go here is the main menu template.

// NOTE:: Base will never be called directly. This is just to test.
$base = getPageBuilderClass('Base');
$base->renderTemplate('base.html');
