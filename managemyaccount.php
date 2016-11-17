<?php


require_once __DIR__ . '/setup/setup.php';

$managemyaccount = getPageBuilderClass('Authentication/','ManageMyAccount');

$messages = [];





if (request('updateaccount')) {
   $email = request('email');
   // $email = urlencode('saie@test.com');
   
   $password = request('password');
   // $password = sdfwenof4930x;

   if ($activation->activate($email, $password, request('useractkey'))) {
      // $messages = $activation->getSuccessMsg();
      $email = urlencode($email);
      header( "refresh:1; url=password.php?fromactivation=true&email=$email&password=$password" ); 
   }
   else {
      $messages = $activation->getErrorMsg();
   }
}



 
$managemyaccount->renderTemplate(
   'managemyaccount.html',
   array(
      'messages' => $messages,
      'firstname' =>$firstname,
      'lastname' => $lastname
   )
);