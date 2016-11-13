<?php

require_once(PROJECT_PATH.'/PageBuilders/Base.php');

class AuthenticationManager extends Base {

   protected $authenticator;

   function __construct() {
      parent::__construct();
      $this->authenticator = getHelperClass('authentication/','auth');

   }

   public function getErrorMsg() {
      return $this->authenticator->errormsg;
   }

   public function getSuccessMsg() {
      return $this->authenticator->successmsg;
   }

   protected function startSession($email, $accesslevel) {
      
      
      // Stores Session in session table
      $this->authenticator->newsession($email);
      $_SESSION['username'] = $email;
      $_SESSION['accessLevel'] = $accesslevel;
   }


}