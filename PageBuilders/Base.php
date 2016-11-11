<?php

class Base {

   protected $DB;

   protected $Twig;
   
   protected $accessLevel;

   protected $baseTemplateArguments = [];
   
   
   function __construct() {
      $this->buildDB();
      $this->buildTwig();
      $this->getAccessLevel();
   }

   protected function buildDB() {
      $this->DB = getHelperClass('database/','DB');
   }

   protected function buildTwig() {
      $loader = new Twig_Loader_Filesystem(PROJECT_PATH.'/Resources/templates/');
      $this->Twig = new Twig_Environment($loader);
   }
   
   protected getAccessLevel() {

      $this->accessLevel = isset($_SESSION['accessLevel']) ? $_SESSION['accessLevel'] : null;
      
      if ($this->accessLevel) {        
         $this->baseTemplateArguments['accessLevel'] = $this->accessLevel;
      }

   }

   public function renderTemplate($template, $templateArguments = null) {

      if ($templateArguments) {
         $this->baseTemplateArguments = array_merge($this->baseTemplateArguments, $templateArguments);
      }

      if (!empty($this->baseTemplateArguments)) {
         echo $this->Twig->render($template, $this->baseTemplateArguments);
      }
      else {
         echo $this->Twig->render($template);
      }

   }
   
   public function getDB() {
      return $this->DB;
   }

}
