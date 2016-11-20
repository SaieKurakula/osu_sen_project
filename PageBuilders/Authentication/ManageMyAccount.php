<?php

require_once(PROJECT_PATH.'/PageBuilders/Authentication/AuthenticationManager.php');

class ManageMyAccount extends AuthenticationManager {

   function __construct() {
      parent::__construct();
   }

   public function getUserName() {

$query = <<<SQL
   SELECT
      firstname,
      lastname
   FROM
      users
   WHERE
      username = ?
SQL;

      return $this->DB->execute($query, array($_SESSION['username']));

   }

   public function updateaccount($firstname, $lastname) {

$query = <<<SQL
   UPDATE
      users
   SET
      firstname = ?,
      lastname = ?
   WHERE
      username = ?
SQL;

      $this->DB->execute($query, array($firstname, $lastname, $_SESSION['username']));
      
      if ($this->DB->getLastErrno() === 0) {
         $this->addSuccessMsg('Update Successful');
         return true;
      }
      else {
         $this->addErrorMsg('Update failed. Error: '. $this->DB->getLastError());
         return false;
      }

   }

}