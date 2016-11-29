 
 <?php

require_once(PROJECT_PATH.'/PageBuilders/Base.php');

class Award extends Base {

   protected $recipientFName;

	function __construct() {
		parent::__construct();
	}
	
	//queries the DB to get possible award types for drop down menu in form
	public function getAwardType() {
		$query = <<<SQL
   SELECT
      *
   FROM
      award
SQL;
		return $this->DB->execute($query);
	}

   public function setRecipientFName($recipientFName) {
      $this->recipientFName = $recipientFName;
   }
   
   
	//function to create the data CSV file
	//calls createAward which in turn calls emailAward
	//also calls saveAwardInfo to save the info in the database
	public function createCSV($columns, $firstname, $lastname, $jobTitle, $recipientFName, $recipientLName, $awardType, $awardDate) {
		
      $this->setRecipientFName($recipientFName);
      
      $data = array($firstname, $lastname, $jobTitle, $awardDate, $awardType, $recipientFName, $recipientLName);
		
      
      
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
		$command = shell_exec('pdflatex certificate.ltx');
		$pdf = dirname(realpath('certificate.pdf'));
		emailAward($pdf);
		
	}
	
	//still under construction
	//function to construct email with PDF of award attached
	public function emailAward($temp) {
		//deciding whether to read file or just pass info
		//$contents = fread($temp, filesize($temp));
		
      $rFName = $this->recipientFName;
      
		//from http://stackoverflow.com/questions/10606558/how-to-attach-pdf-to-email-using-php-mail-function
		$mail = new PHPMailer();
		
		$body = "Congratulations $rFName $rLName!!\n
				$firstname $lastname has presented you with an award for \n
				$awardType.See the attached document to view it.\n
				Thank you for your continued hard work!";
		
		$mail->AddReplyTo($email, $firstname $lastname);
		$mail->SetFrom($email, $firstname $lastname);		
		$mail->AddAddress($remail, $rFName $rLName);
		
		$mail->Subject = "$firstname $lastname has given you an award!";
		$mail->MsgHTML($body);
		
		mail->AddAttachment("award.pdf");
		
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Message sent.";
		}
	}
	
	public function saveAwardInfo($temp){
		//Not entirely sure yet how to send the info to the DB
		//Do I need to query first to get the foreign key IDs?
		//To be continued...
		$query = <<<SQL
	INSERT INTO award_record
	VALUES
	
SQL;
		return;
	}
}