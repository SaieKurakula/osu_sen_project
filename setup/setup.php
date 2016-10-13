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

function request($requestVar) {
   $returnValue = isset($_REQUEST[$requestVar]) ? $_REQUEST[$requestVar] : null;
   return $returnValue;
}

function getPageBuilderClass($pageBuilderClass) {

   require_once(PROJECT_PATH.'/PageBuilders/' . $pageBuilderClass . '.php');

   $page = null;

   if ($pageBuilderClass=='Login') {
      $page = new $pageBuilderClass(true);
   }
   else {
      $page = new $pageBuilderClass();
   }

   return $page;

}