<?php

class Base {

   protected $DB;

   protected $Twig;


   function __construct($loginPage=false) {

      // Verifies that user has logged in. If not, then it will return to the main page
      // and go through log in procedure
      if (!isset($_SESSION['userID']) && !$loginPage) {
         header('Location: login.php');
      }

      $this->buildDB();
      $this->buildTwig();
   }

   protected function buildDB() {
      $this->DB = getHelperClass('database/','DB');
   }

   protected function buildTwig() {
      $loader = new Twig_Loader_Filesystem(PROJECT_PATH.'/Resources/templates/');
      $this->Twig = new Twig_Environment($loader);
   }

   public function renderTemplate($template, $templateArguments = null) {

      if ($templateArguments) {
         echo $this->Twig->render($template, $templateArguments);
      }
      else {
         echo $this->Twig->render($template);
      }

   }
   
   public function getDB() {
      return $this->DB;
   }

}
