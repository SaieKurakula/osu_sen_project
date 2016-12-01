<?php

require_once __DIR__ . '/setup/setup.php';

$viewawards = getPageBuilderClass('','ViewAwards');

$messages = [];

$awardsFromUser = $viewawards->getUserGeneratedAwards();

// var_dump($awardsFromUser);


// This is when the form has been submitted.
// if (request('deleteawards')) {

   $awardIDs = request('awardIDs');
// var_dump($awardIDs);


   // if ($viewawards->deleteUserGeneratedAwards($awardIDs)) {
      // $messages = $registration->getSuccessMsg();
   // }
   // else {
      // $messages = $registration->getErrorMsg();
   // }

// }


$viewawards->renderTemplate('viewawards.html',array('messages' => $messages, 'awardsFromUser'=>$awardsFromUser));