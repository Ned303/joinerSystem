<?php

	use Zend\Log\Logger;

	class JobRoles
	{
		public function getJobRoles($companyID)
		{
			$allJobRoles = array();

			$sql = "SELECT jobID, jobName FROM jobroles WHERE companyId = $companyID";

			$objDB = new Database();
			$result = $objDB->execute($sql);
			$dbResult = $result->current();

			if ($dbResult == null) {
				$objLog = new Log();
				$logger = $objLog->getErrorLog();

				$logger->log(Logger::ERR, 'There are no jobroles with the company id [' . $companyID . ']');
				header("Location:views/error.html");
				die();
			} else {
				$dbResult = $result->current();

				while (!array_key_exists($dbResult['jobID'], $allJobRoles)) {
					$dbResult = $result->current();
					$allJobRoles[$dbResult['jobID']] = $dbResult['jobName'];

					$result->next();
					$dbResult = $result->current();
				}
			}

			return $allJobRoles;
		}
	}

?>