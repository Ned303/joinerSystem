<?php

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
				header("Location:views/error.html");
				die();
			}
		}
	}