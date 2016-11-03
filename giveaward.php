<?php

require_once __DIR__ . '/setup/setup.php';

$award = getPageBuilderClass('GiveAward');

$award->renderTemplate('giveaward.html',array('users'=>$users, 'messages' => $messages));
//I'm not sure what the array is for yet. I'll keep figuring it out - that's why it's probably not right.