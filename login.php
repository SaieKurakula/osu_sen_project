<?php

require_once __DIR__ . '/setup/setup.php';

$login = getPageBuilderClass('Login');

$users = $login->getUsersTest();

// $username = 'SaieTest5';
// $password = 'PassTest5';
// $verifypassword = 'PassTest5';
// $email = 'SaieTest5@test.com';

$messages = '';
if ($login->registerUser($username, $password, $verifypassword, $email)) {
   $messages = $login->getSuccessMsg();
}
else {
   $messages = $login->getErrorMsg();
}

var_dump($_SESSION);



$login->renderTemplate('login.html',array('users'=>$users, 'messages' => $messages));





