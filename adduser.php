<?php

require_once __DIR__ . '/setup/setup.php';

$registration = getPageBuilderClass('Authentication/','Registration');

$messages = [];


   // Will Need to dynamically generate these
   $accesslevels = array(
      '1'=>'Admin',
      '3'=>'Normal'
   );

// $logout->logout();
// $messages = $login->getSuccessMsg();

// This is when the form has been submitted.
if (request('adduser')) {

   $firstName = request('firstname');
   $lastName = request('firstname');
   $email = request('email');
   $accessLevel = request('accessLevel');

   if ($registration->registerUser($firstName, $lastName, $email, $accessLevel)) {
      $messages = $registration->getSuccessMsg();
   }
   else {
      $messages = $registration->getErrorMsg();
   }

}

/************************
 * END Registration Test
 *********************/

$registration->renderTemplate('adduser.html',array('messages' => $messages, 'accesslevels'=>$accesslevels));