<?php

require_once __DIR__ . '/setup/setup.php';

$viewawards = getPageBuilderClass('','ViewAwards');

$messages = [];

$awardsFromUser = $viewawards->getUserGeneratedAwards();


// This is when the form has been submitted.
if (request('deleteawards')) {

   $awardIDs = 

   if ($viewawards->deleteUserGeneratedAwards($awardIDs)) {
      $messages = $registration->getSuccessMsg();
   }
   else {
      $messages = $registration->getErrorMsg();
   }

}


$registration->renderTemplate('viewawards.html',array('messages' => $messages, 'awardsFromUser'=>$awardsFromUser));