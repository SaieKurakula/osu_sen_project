<?php

require_once __DIR__ . '/setup/setup.php';


$passwordAuth = getPageBuilderClass('Authentication/','Password');


$messages = [];

$email = request('email');
$password = request('password');
$fromactivation = request('fromactivation');

// echo "Hello!";


if (request('resetpassword')) {

   if ($passwordAuth->resetPassword(
      $email,
      $password,
      request('newpassword'),
      request('verifynewpassword')
   ) {
      $messages = $passwordAuth->getSuccessMsg();
   }
   else {
      $messages = $passwordAuth->getErrorMsg();
   }
   
}




$passwordAuth->renderTemplate(
   'password.html',
   array(
      'messages' => $messages,
      'email' => $email,
      'password' => $password,
      'fromactivation' => $fromactivation
   )
);