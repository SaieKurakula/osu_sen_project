<?php

require_once __DIR__ . '/setup/setup.php';

$award = getPageBuilderClass('','GiveAward');

//Will need to dynamically generate this from DB:
$awardTypes = $award->getAwardType();
$

//These are for the user session info (aka person giving award)
//to pre-populate in form
$email = request('email');
$firstname = request('firstname');
$lastame = request('lastname');

//This is when the form has been submitted:
if(request('giveaward')) {
	$award->setGiverTitle(request('title'));
	$award->setRecipientFName(request('rFName'));
	$award->setRecipientLName(request('rLName'));
	$award->setRecipientEmail(request('remail'));
	$award->setAwardType(request('awardType'));
	$award->setAwardDate(request('date'));
		
	//create column headers for .csv
	$columns = array('GiverFName', 'GiverLName', 'Title', 'Date', 'Type', 'RecFName', 'RecLName');
	
	$award->createCSV($columns, $firstname, $lastname, $jobTitle, $recipientFName, $recipientLName, $awardType, $awardDate, $email, $recipientEmail);
}

$award->renderTemplate('giveaward.html',
	array(
			'firstname'=>$firstname, 
			'lastname'=>$lastname, 
			'email'=>$email, 
			'awardType'=>$awardTypes
			
	)
);
