<?php

class Base {

   protected $Twig;

   protected $DB;

   function __construct($loginPage=false) {

      // Verifies that user has logged in. If not, then it will return to the main page
      // and go through log in procedure
      if (!isset($_SESSION['userID']) && !$loginPage) {
         // NEED TO BUILD LOG IN FUNCTIONALITY AND THEN UNCOMMENT

         header('Location: login.php');
      }

      $this->buildTwig();
      $this->buildDB();
   }

   protected function buildTwig() {
      $loader = new Twig_Loader_Filesystem(PROJECT_PATH.'/Resources/templates/');
      $this->Twig = new Twig_Environment($loader);
   }

   protected function buildDB() {
      // NEED TO ADD DB CLASS HERE.
   }

   public function renderTemplate($template, $templateArguments = null) {

      if ($templateArguments) {
         echo $this->Twig->render($template, $templateArguments);
      }
      else {
         echo $this->Twig->render($template);
      }

   }

}
