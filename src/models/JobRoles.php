<?php

class JobRoles{
	public function getJobRoles( $companyID ) {
	    $allJobRoles = array();

        $sql = "SELECT jobID, jobName FROM jobroles WHERE companyId = $companyID";

        $objDB = new Database();
        $result = $objDB->execute($sql);
        $dbResult = $result->current();


        if($dbResult == null) {
            throw Exception("There are no jobroles set up for your company with id $companyID");
        } else {
            $allJobRoles[$dbResult['jobID']] = $dbResult['jobName'];
            while($result->next()){
                $dbResult = $result->current();
                $allJobRoles[$dbResult['jobID']] = $dbResult['jobName'];
            }
        }

        return $allJobRoles;
	}
}
?>