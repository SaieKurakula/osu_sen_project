<?php

/**
 *
 * This class will hold the mysql link statically to avoid creating multple connections
 *
 *
 */

class MysqlConn {

   public static $connections;

   static function __init()
   {
      if (!isset(self::$connections)) {
         self::$connections = array();
      }
      
   }

   public function setConnection($connectionName, $connection) {
      self::$connections[$connectionName] = $connection;
   }

   public function getConnection($connectionName) {
      return self::$connections[$connectionName];
   }

}
MysqlConn::__init();