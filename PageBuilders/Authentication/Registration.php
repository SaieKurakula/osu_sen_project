<?php

require_once(PROJECT_PATH.'/PageBuilders/Authentication/AuthenticationManager.php');

class Registration extends AuthenticationManager {

   function __construct() {
      parent::__construct();
   }

   public function registerUser($firstName, $lastName, $email, $accessLevel) {
      return $this->authenticator->register($firstName, $lastName, $email, $accessLevel);
   }

}