<?php

define('PROJECT_PATH', realpath(dirname(__FILE__) . '/..'));

require_once(PROJECT_PATH.'/Resources/config/config.php');
require_once(PROJECT_PATH.'/Helpers/database/mysqlconn.php');
require_once(PROJECT_PATH.'/vendor/autoload.php');

// Check if Default DB Connection has been created.
// If not then create connection.
if (!(MysqlConn::getConnection('Default'))) {

   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
       or die("Error connecting to database server");

   MysqlConn::setConnection('Default', $link);

}

session_start();

// check if we're on the login page
$loginPage = strpos(basename($_SERVER[REQUEST_URI]), 'login.php') !== false;

// Verifies that user has logged in. If not, then it will return to the main page
// and go through log in procedure
if (!isset($_SESSION['username']) && !$loginPage) {
   header('Location: login.php');
}


function request($requestVar) {
   $returnValue = isset($_REQUEST[$requestVar]) ? $_REQUEST[$requestVar] : null;
   return $returnValue;
}

function getPageBuilderClass($pageBuilderClass) {

   require_once(PROJECT_PATH.'/PageBuilders/' . $pageBuilderClass . '.php');

   return new $pageBuilderClass();


}


function getHelperClass($pathInHelpers, $helperClass) {

   require_once(PROJECT_PATH.'/Helpers/'. $pathInHelpers . $helperClass . '.php');
   return new $helperClass();

}

