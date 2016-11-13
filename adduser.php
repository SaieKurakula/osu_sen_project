<?php

require_once __DIR__ . '/setup/setup.php';

$registration = getPageBuilderClass('Authentication/','Registration');

$messages = [];

// Will Need to dynamically generate these
$accesslevels = $registration->getAccessLevels();

// This is when the form has been submitted.
if (request('adduser')) {

   $firstName = request('firstname');
   $lastName = request('firstname');
   $email = request('email');
   $accessLevel = request('accesslevel');
   
   var_dump($accessLevel);
   die();

   if ($registration->registerUser($email, $accessLevel, $firstName, $lastName)) {
      $messages = $registration->getSuccessMsg();
   }
   else {
      $messages = $registration->getErrorMsg();
   }

}


$registration->renderTemplate('adduser.html',array('messages' => $messages, 'accesslevels'=>$accesslevels));