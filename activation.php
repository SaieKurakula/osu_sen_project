<?php

require_once __DIR__ . '/setup/setup.php';


$activation = getPageBuilderClass('Authentication/','Activation');

$messages = [];

$key = request('key');

if (request('useractivation')) {
   if ($activation->activate(request('email'), request('password'), request('useractkey'))) {
      // $messages = $activation->getSuccessMsg();
      header( "refresh:5; url=password.php?reset=true" ); 
   }
   else {
      $messages = $activation->getErrorMsg();
   }
}


// $logout->logout();
// $messages = $login->getSuccessMsg();
 

/************************
 * Activation Test
 *********************/


/************************
 * End Activation Test
 *********************/
 
$activation->renderTemplate('activation.html',array('messages' => $messages, 'key' => $key));