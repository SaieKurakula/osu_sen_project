<?php

require_once(PROJECT_PATH.'/PageBuilders/Authentication/AuthenticationManager.php');

class Activation extends AuthenticationManager {

   function __construct() {
      parent::__construct();
   }

   public function activate($email, $password, $key) {
      if ($this->authenticator->activate($email, $password, $key)) {
         $this->startSession($email);
         return true;
      }
      return false;
   }


}