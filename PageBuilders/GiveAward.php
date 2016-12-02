 
 <?php

require_once(PROJECT_PATH.'/PageBuilders/Base.php');

class GiveAward extends Base {

	protected $giverFName;
	protected $giverLName;
	protected $giverEmail;
	protected $giverTitle;
	protected $recipientFName;
	protected $recipientLName;
	protected $recipientEmail;
	protected $awardType;
	protected $awardDate;
	//protected $awardCity;
	protected $awardRegion;

	function __construct() {
		parent::__construct();
	}
	
	public function setGiverFName($giverFName) {
		$this->giverFName = $giverFName;
	}
	
	public function setGiverLName($giverLName) {
		$this->giverLName = $giverLName;
	}
	
	public function setGiverEmail($giverEmail) {
		$this->giverEmail = $giverEmail;
	}
	
	public function setGiverTitle($giverTitle) {
		$this->giverTitle = $giverTitle;
	}
	
	public function setRecipientFName($recipientFName) {
		$this->recipientFName = $recipientFName;
	}
	
	public function setRecipientLName($recipientLName) {
		$this->recipientLName = $recipientLName;
	}
	
	public function setRecipientEmail($recipientEmail) {
		$this->recipientEmail = $recipientEmail;
	}
	
	public function setAwardType($awardType) {
		$this->awardType = $awardType;
	}
	
	public function setAwardDate($awardDate) {
		$this->awardDate = $awardDate;
	}
	
	// public function setAwardCity($awardCity) {
	// 	$this->awardCity = $awardCity;
	// }

		public function setAwardRegion($awardRegion) {
		$this->awardRegion = $awardRegion;
	}

	//queries the DB to get possible award types for drop down menu in form
	public function getAwardType() {
		$query = <<<SQL
   		SELECT
      	award_class
   		FROM
      	award
SQL;
		return $this->DB->execute($query);
	}

// 	//queries the DB to get possible award cities for drop down menu in form
// 	public function getAwardCities() {
// 		$query = <<<SQL
//    		SELECT
//       	city
//    		FROM
//       	region
// SQL;
// 		return $this->DB->execute($query);
// 	}

		//queries the DB to get possible award regions for drop down menu in form
	public function getAwardRegions() {
		$query = <<<SQL
   		SELECT
      	region_name
   		FROM
      	region
SQL;
		return $this->DB->execute($query);
	}

	//queries the DB to get user (aka the giver) info
	public function getGiverInfo() {
		$query = <<<SQL
		SELECT
		firstname, lastname
		FROM
		users
		WHERE
		username = ?
SQL;
		return $this->DB->execute($query, array($_SESSION['username']));
	}

	//function to create the data CSV file
	//calls createAward which in turn calls emailAward
	//also calls saveAwardInfo to save the info in the database
	public function createCSV() {
		      
		$data = array($this->giverFName, $this->giverLName, $this->giverTitle, $this->awardDate, $this->awardType, $this->recipientFName, $this->recipientLName);
      
		//create column headers for .csv
		$columns = array('GiverFName', 'GiverLName', 'Title', 'Date', 'Type', 'RecFName', 'RecLName');      

		//from http://php.net/manual/en/function.tmpfile.php in comments section for creating specific file extension
		$temp = array_search('uri', @array_flip(stream_get_meta_data($GLOBALS[mt_ran()]=tmpfile())));
		rename($temp, $temp.='.csv');
		
		//Write column names & form data to .csv file
		fwrite($temp, $columns);
		fwrite($temp, $data);
		fseek($temp, 0);
		
		//while $temp file is still linked, createAward with the data
		//createAward calls the emailAward function
		createAward($temp);
	
		//while $temp file is still linked, saveAwardInfo to database
		saveAwardInfo($temp);
		
		//I don't know if this goes before I do stuff with my temp file, or after
		register_shutdown_function(create_function('', "unlink('{$temp}');"));
	}
	
	//still under construction
	//function to actually create the pdf award from the latex script
	public function createAward($temp){
		$command = shell_exec('pdflatex Helpers/award/certificate.tex');
		$pdf = dirname(realpath('certificate.pdf'));
		readfile($pdf);
		emailAward($pdf);
	}
	
	//still under construction
	//function to construct email with PDF of award attached
	public function emailAward($temp) {
		//from http://stackoverflow.com/questions/10606558/how-to-attach-pdf-to-email-using-php-mail-function
		$mail = new PHPMailer();
		
		$body = "Congratulations $this->recipientFName $this->recipientLName!!\n
				$this->giverFName $this_->giverLName has presented you with an award for \n
				$this->awardType.See the attached document to view it.\n
				Thank you for your continued hard work!";
		
		$mail->AddReplyTo("$this->giverEmail", "$this->giverFName $this->giverLName");
		$mail->SetFrom("$this->giverEmail", "$this->giverFName $this->giverLName");		
		$mail->AddAddress("$this->recipientEmail", "$this->recipientFName $this->recipientLName");
		
		$mail->Subject = "$this->recipientFName $this->recipientLName has given you an award!";
		$mail->MsgHTML($body);
		
		$mail->AddAttachment("award.pdf");
		
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Message sent.";
		}
	}
	
	public function saveAwardInfo($temp){
		//query DB for user ID which is foreign key in award_record table
		$userIDquery = <<<SQL
		SELECT
		id
		FROM
		users
		WHERE
		username = ?
SQL;
		$userID = $this->DB->execute($userIDquery, array($_SESSION['username']));
		
		//query DB for award ID which is foreign key in award_record table
		$awardIDquery = <<<SQL
		SELECT
		id
		FROM
		award
		WHERE
		award_class = ?
SQL;
		$awardID = $this->DB->execute($awardIDquery, array($this->awardType));

		//query DB for region ID which is foreign key in award_record table
		$regionIDquery = <<<SQL
		SELECT
		region_id
		FROM
		region
		WHERE
		region_name = ?
SQL;
		$regionID = $this->DB->execute($regionIDquery, array($this->awardRegion));

		$Insertquery = <<<SQL
		INSERT INTO 
		award_record (recipient_lname, recipient_fname, award_create_date, user_ID, awd_ID, reg_ID, recipient_email)
		VALUES
		(?, ?, ?, ?, ?, ?, ?)
		
	
SQL;
		return $this->DB->execute(
         $Insertquery,
         array(
            $this->recipientLName,
            $this->recipientFName,
            $this->awardDate,
            $userID,
            $awardID,
            $regionID,
            $this->recipientEmail
         )
      );
	}
}
