<?php

require_once __DIR__ . '/setup/setup.php';

$login = getPageBuilderClass('Authentication/','Login');

$messages = [];

if (request('forgotpassword')) {

   if ($login->getForgottenPassword(request('email'))) {
      $messages = $login->getSuccessMsg();
   }
   else {
      $messages = $login->getErrorMsg();
   }

}

if (request('userlogin')) {
   
   $email = request('email');
   $password = request('password');
   
   if ($login->login($email, $password)) {
   
      $resetkey = request('resetkey');
      if ($resetkey) {
         $email = urlencode($email);
         header( "refresh:1; url=password.php?fromforgot=true&email=$email&password=$password&resetkey=$resetkey");    
      }
      
      $messages = $login->getSuccessMsg();
   }
   else {
      $messages = $login->getErrorMsg();
   }
   
}


$login->renderTemplate(
   'login.html',
   array(
      'users'=>$users,
      'messages' => $messages,
      'forgot'=>request('forgot'),
      'resetkey'=>request('resetkey')
   )
);
