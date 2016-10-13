<?php

require_once(PROJECT_PATH.'/PageBuilders/Base.php');

class Login extends Base {

   var $authenticator;

   function __construct($loginPage) {
      parent::__construct($loginPage);
   }

}