<?php

require_once(PROJECT_PATH.'/PageBuilders/Base.php');

class Login extends Base {

   protected $authenticator;

   function __construct() {
      parent::__construct();

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

      $_SESSION['username'] = $username;

   }

   public function logOut() {
      $sessionHash = $this->authenticator->getSessionHash($_SESSION['username']);

      unset($_SESSION['username']);
      return $this->authenticator->deletesession($sessionHash);

   }

   public function login($username, $password) {
      return $this->authenticator->login($username, $password);
   }

   public function activate($username, $key) {
      return $this->authenticator->activate($username, $key);
      $_SESSION['username'] = $username;
   }

}