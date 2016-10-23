<?php

require_once(PROJECT_PATH.'/PageBuilders/Authentication/AuthenticationManager.php');

class Password extends AuthenticationManager {

   function __construct() {
      parent::__construct();
   }

// Will need to add forgot password functionality and reset password functionality
   
   
   // public function login($username, $password) {
      // return $this->authenticator->login($username, $password);
   // }


}