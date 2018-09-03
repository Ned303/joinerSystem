<?php

	use Zend\Log\Logger;

	class Database
	{

		public function execute($sql)
		{
			try{
				$objApplication = new Application();

				$arrConDetails = $objApplication->getDBDetails();

				$objAdapter = new Zend\Db\Adapter\Adapter($arrConDetails);

				$statement = $objAdapter->query($sql);

				$result = $statement->execute();

				return $result;
			} catch (Exception $e) {
				$objLog = new Log();
				$logger = $objLog->getErrorLog();

				$logger->log(Logger::ERR, 'An error occurred with the database: ' . $e->getMessage());

				header("Location:views/error.html");
				die();
			}
		}
	}