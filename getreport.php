<?php

require_once __DIR__ . '/setup/setup.php';

$getreport = getPageBuilderClass('','GetReport');

//$messages = [];

	//Will dynamically generate this from DB:
//$awardsPerRegion = $getreport->getAwardsPerRegion();

$reportType = request('reporttype');
// This is when the "get report type" has been submitted
if ($reportType == 'Awards by Region') {

}

$getreport->renderTemplate('getreport.html',
	array()
);