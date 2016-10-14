<?php

require_once(PROJECT_PATH.'/PageBuilders/Base.php');

class Login extends Base {

   var $authenticator;

   function __construct($loginPage) {
      parent::__construct($loginPage);
   }

   public function getActorsTest() {

$query = <<<SQL
   SELECT
      *
   FROM
      actor
SQL;

      return $this->DB->execute($query);
      
   }
   
}