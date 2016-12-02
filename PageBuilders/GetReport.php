<?php
require_once(PROJECT_PATH.'/PageBuilders/Base.php');
 
class GetReport extends Base {
	function __construct() {
		parent::__construct();
	}
}
//queries the DB to get awards per region for graph
/*public function getAwardsPerRegion() {
	$query = <<<SQL
	SELECT
		region_name, COUNT(award_record.award_record_ID) AS award_count
	FROM
		region
	INNER JOIN
		award_record
	ON
		region.region_ID=award_record.reg_ID
	GROUP BY
		region_name
SQL;
	return $this->DB->execute($query);
}*/

//queries the DB to get
/*public function getRegions() {
   $query = <<<SQL
   SELECT
      *
   FROM
      region
SQL;
		
		return $this->DB->execute($query);
   }*/
	
//queries the DB to get 
/*public function getNames() {
   $query = <<<SQL
   SELECT
		lastname, firstname
   FROM
		users
SQL;
		
		return $this->DB->execute($query);
   }*/
