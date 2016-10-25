<?php

require_once __DIR__ . '/setup/setup.php';


$password = getPageBuilderClass('Authentication/','Password');

$messages = [];

echo "Hello!";

// if (request('useractivation')) {
   // if ($activation->activate(request('email'), request('password'), request('useractkey'))) {
      // $messages = $activation->getSuccessMsg();
   // }
   // else {
      // $messages = $activation->getErrorMsg();
   // }
// }


$password->renderTemplate('password.html',array('messages' => $messages));