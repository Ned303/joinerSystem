<?php

class JobRoles{
	public function getJobRoles( $companyID ) {
        $sql = "SELECT jobID, jobName FROM jobroles WHERE companyId = $companyID";

        $objDB = new Database();
        $result = $objDB->execute($sql);
        $dbResult = $result->current();

        if($dbResult == null) {
            throw Exception("There are no jobroles set up for your company with id $companyID");
        } else {
            echo $dbResult;
            die();
        }

        return array('SomeJob','MyRandomJob','CommonJob','Jobless');
	}
}
?>