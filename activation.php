<?php

require_once __DIR__ . '/setup/setup.php';


$activation = getPageBuilderClass('Authentication/','Activation');

$messages = [];
// $logout->logout();
// $messages = $login->getSuccessMsg();
 
$firstName = 'Saie';
$lastName = 'Test10';
// $password = 'PassTest8';
// $verifypassword = 'PassTest8';
$email = 'kurakuls+Test13@oregonstate.edu';
$accessLevel = 'admin';

/************************
 * Activation Test
 *********************/

// if ($registration->activate(request('username'), request('password'), request('key'))) {
   // $messages = $registration->getSuccessMsg();
// }
// else {
   // $messages = $registration->getErrorMsg();
// }

/************************
 * End Activation Test
 *********************/
 
$activation->renderTemplate('activation.html',array('messages' => $messages));