<?php

define('PROJECT_PATH', realpath(dirname(__FILE__) . '/..'));

require_once(PROJECT_PATH.'/Resources/config/config.php');
require_once(PROJECT_PATH.'/Helpers/database/mysqlconn.php');
require_once(PROJECT_PATH.'/vendor/autoload.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Check if Default DB Connection has been created.
// If not then create connection.
if (!(MysqlConn::getConnection('Default'))) {

   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
       or die("Error connecting to database server");

   MysqlConn::setConnection('Default', $link);

}

session_start();

function isAccessiblePage() {

   $unauthenticatedPages = array (
      'login.php',
      'activation.php',
      'adduser.php' // THIS IS TEMP WE NEED TO REMOVE THIS
   );

   $currentPage = basename($_SERVER[REQUEST_URI]);

   foreach($unauthenticatedPages as $page) {
      if (strpos($currentPage, $page) !== false) {
         return true;
      }
   }

   return false;

}

// Verifies that user has logged in. If not, then it will return to the main page
// and go through log in procedure
if (!isset($_SESSION['username']) && !isAccessiblePage()) {
   header('Location: login.php');
}


function request($requestVar) {
   $returnValue = isset($_REQUEST[$requestVar]) ? $_REQUEST[$requestVar] : null;
   return $returnValue;
}

function getPageBuilderClass($pathInPageBuilders, $pageBuilderClass) {
   require_once(PROJECT_PATH.'/PageBuilders/'. $pathInPageBuilders . $pageBuilderClass . '.php');
   return new $pageBuilderClass();
}

function getHelperClass($pathInHelpers, $helperClass) {
   require_once(PROJECT_PATH.'/Helpers/'. $pathInHelpers . $helperClass . '.php');
   return new $helperClass();
}

