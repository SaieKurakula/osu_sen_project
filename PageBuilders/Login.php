<?php

require_once(PROJECT_PATH.'/PageBuilders/Base.php');

class Login extends Base {

   protected $authenticator;

   function __construct($loginPage) {
      parent::__construct($loginPage);
      
      $this->authenticator = getHelperClass('authentication/','auth');

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

   public function getErrorMsg() {
      return $this->authenticator->errormsg;
   }
   
   public function getSuccessMsg() {
      return $this->authenticator->successmsg;
   }

   public function registerUser($username, $password, $verifypassword, $email) {      
      $success = $this->authenticator->register($username, $password, $verifypassword, $email);
      if ($success) {
         $this->startSession($username);
         return true;
      }
      return false;
   }
   
   protected function startSession($username) {
      // Stores Session in session table
      $this->authenticator->newsession($username);
      
      // Local Session
      // startSetupSession();
      
      $_SESSION['username'] = $username;
      
      
   }
 
}