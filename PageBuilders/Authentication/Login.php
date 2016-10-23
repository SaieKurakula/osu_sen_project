<?php

require_once(PROJECT_PATH.'/PageBuilders/Authentication/AuthenticationManager.php');

class Login extends AuthenticationManager {

   function __construct() {
      parent::__construct();
   }

   public function getUsersTest() {

$query = <<<SQL
   SELECT
      *
   FROM
      users
SQL;

      return $this->DB->execute($query);

   }


   public function login($email, $password) {
      if ($this->authenticator->login($email, $password)) {
         $this->startSession($email);
         return true;
      }
      return false;
   }

}