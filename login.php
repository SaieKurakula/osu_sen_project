<?php

require_once __DIR__ . '/setup/setup.php';

$login = getPageBuilderClass('Authentication/','Login');


$logout = getPageBuilderClass('Authentication/','Logout');

$logout->logout();


$users = $login->getUsersTest();

$messages = [];

if (request('userlogin')) {
   
   if ($login->login(request('email'), request('password'))) {
      $messages = $login->getSuccessMsg();
   }
   else {
      $messages = $login->getErrorMsg();
   }
   
}







 
/************************
 * Login Test
 *********************/



/************************
 * End Login Test
 *********************/
 
 
/************************
 * Logout Test
 *********************/


// $login->logout();
// $messages = $login->getSuccessMsg();


/************************
 * END Logout Test
 *********************/


 



$login->renderTemplate('login.html',array('users'=>$users, 'messages' => $messages));





