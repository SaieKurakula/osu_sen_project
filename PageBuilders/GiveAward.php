 
 <?php

require_once(PROJECT_PATH.'/PageBuilders/Base.php');

class Award extends Base {

	function __construct() {
		parent::__construct();
	}
	
	public function getAwardType() {
	
		$query = <<<SQL
   SELECT
      *
   FROM
      award
SQL;
	
		return $this->DB->execute($query);
	}
	
	public funciton saveAwardInfo(){
		//Not entirely sure yet how to send the info to the DB
		//Do I need to query first to get the foreign key IDs?
		//To be continued...
		$query = <<<SQL
	INSERT INTO award_record
	VALUES
	
SQL;
	}
	
	public function createAward() {
		//still working on this part too - determining if .csv file is needed
		//I also will need to require the Helpers/award - HELP :) 
	}
	
	public function emailAward($email, $firstname, $lastname, $remail, $rFName, $rLName, $awardType) {
		$to = $remail;
		$subject = "$firstname $lastname has given you an award!";
		$txt = "Congratulations $rFName $rLName!!\n
				$firstname $lastname has presented you with an award for \n
				$awardType.See the attached document to view it.\n
				Thank you for your continued hard work!";
		$headers = "From: $email";
		
		mail($to,$subject,$txt,$headers);
	}
}