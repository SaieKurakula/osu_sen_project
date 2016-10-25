<?php

require_once(PROJECT_PATH.'/PageBuilders/Authentication/AuthenticationManager.php');

class Registration extends AuthenticationManager {

   function __construct() {
      parent::__construct();
      

   }

   public function registerUser($email, $accessLevel, $firstName, $lastName) {
      return $this->authenticator->register($email, $accessLevel, $firstName, $lastName);
   }

}