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