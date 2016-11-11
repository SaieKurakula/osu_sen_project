<?php

require_once(PROJECT_PATH.'/PageBuilders/Authentication/AuthenticationManager.php');

class Logout extends AuthenticationManager {

   function __construct() {

      
      parent::__construct();
   }

   public function logOut() {
      $sessionHash = $this->authenticator->getSessionHash($_SESSION['username']);
      unset($_SESSION['username']);
      return $this->authenticator->deletesession($sessionHash);
   }

}