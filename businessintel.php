<?php

require_once __DIR__ . '/setup/setup.php';

$getreport = getPageBuilderClass('','BusinessIntel');

//$messages = [];

//Will need to dynamically generate this from DB:
$reportTypes = $businessintel->getReportType();
$regions = $businessintel->getRegion();
$names = $businessintel->getNames();
//$firstname = $businessintal->getFirstNames();

// This is when the getreport form has been submitted.
if (request('getreport')) {

}

$getreport->renderTemplate('businessintel.html',
	array('reporttypes' => $reportTypes,
			'regions' => $regions,
			'names' => $names)
);