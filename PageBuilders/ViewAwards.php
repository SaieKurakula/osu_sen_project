<?php

require_once(PROJECT_PATH.'/PageBuilders/Base.php');
 
class ViewAwards extends Base {

   function __construct() {
      parent::__construct();
   }

   public function getUserGeneratedAwards($username=null) {
      
      $username= isset($username) ? $username : $_SESSION['username'];
      
      $query = <<<SQL
SELECT
   *
FROM
   award_record ar
   JOIN users u ON (ar.usr_ID=u.id)
WHERE
   u.username = ?
   AND ar.show_award = ?
SQL;

		return $this->DB->execute($query, array($username, 1));

   }

   // For the sake of business intelligence, we don't actually delete any awards.
   // We mark the column 'show_award' as 'false' and just hide it from the user.
public function deleteUserGeneratedAwards($awardIDs, $username=null) {
      
      $username= isset($username) ? $username : $_SESSION['username'];

      $paramList = implode(', ', array_fill(0, count($awardIDs), '?'));

      $query = <<<SQL
UPDATE
   award_record
SET
   show_award = ?
WHERE
   award_record_ID IN ({$paramList})
SQL;

		$this->DB->execute($query, array(0, $awardIDs));
      
      // NEED TO VERIFY IF I CAN'T FIND ARRAY EXPLOADING      
      // foreach($awardIDs as $awardID) {
         // $query = <<<SQL
// UPDATE
   // award_record
// SET
   // show_award = ?
// WHERE
   // award_record_ID = ?
// SQL;

		// $this->DB->execute($query, array(0, $awardID));

         
      // }

   }   
   
}