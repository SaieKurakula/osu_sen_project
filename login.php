<?php

require_once __DIR__ . '/setup/setup.php';

$login = getPageBuilderClass('Authentication/','Login');


$logout = getPageBuilderClass('Authentication/','Logout');

$users = $login->getUsersTest();

$messages = [];

$logout->logout();



 
/************************
 * Login Test
 *********************/

// if ($login->login($username, $password)) {
   // $messages = $login->getSuccessMsg();
// }
// else {
   // $messages = $login->getErrorMsg();
// }

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





