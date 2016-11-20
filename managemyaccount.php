<?php

   
require_once __DIR__ . '/setup/setup.php';


$managemyaccount = getPageBuilderClass('Authentication/','ManageMyAccount');

$messages = [];

$userName = $managemyaccount->getUserName();

$firstname = $userName[0]['firstname'];
$lastname = $userName[0]['lastname'];

if (request('updateaccount')) {
   $firstname = request('firstname');
   $lastname = request('lastname');
   if ($managemyaccount->updateaccount($firstname, $lastname)) {
      $messages = $managemyaccount->getSuccessMsg();
   }
   else {
      $messages = $managemyaccount->getErrorMsg();
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