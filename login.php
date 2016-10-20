<?php

require_once __DIR__ . '/setup/setup.php';

$login = getPageBuilderClass('Login');

$users = $login->getUsersTest();

$messages = '';


// var_dump($_SESSION);

// echo"here!";
// var_dump($users);


/************************
 * Registration Test
 *********************/
 
// $username = 'SaieTest8';
// $password = 'PassTest8';
// $verifypassword = 'PassTest8';
// $email = 'kurakuls+Test8@oregonstate.edu';


// if ($login->registerUser($username, $password, $verifypassword, $email)) {
   // $messages = $login->getSuccessMsg();
// }
// else {
   // $messages = $login->getErrorMsg();
// }

/************************
 * END Registration Test
 *********************/


/************************
 * Activation Test
 *********************/
 
 
if ($login->activate(request('username'), request('key'))) {
   $messages = $login->getSuccessMsg();
}
else {
   $messages = $login->getErrorMsg();
}

/************************
 * End Activation Test
 *********************/


 
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





