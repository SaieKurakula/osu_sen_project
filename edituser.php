<?php

require_once __DIR__ . '/setup/setup.php';

$editUser = getPageBuilderClass('Authentication/','ViewEditUser');

$messages = [];

// Will Need to dynamically generate these
$accesslevels = $viewEditUser->getAccessLevels();

// This is when the form has been submitted.
if (!$userID = request('userID')) {

   if ($viewEditUser->deleteUsers($userIDs)) {
      $messages = $viewEditUser->getSuccessMsg();
   }
   else {
      $messages = $viewEditUser->getErrorMsg();
   }

}

$viewEditUser->renderTemplate('viewedituser.html',array('messages' => $messages));