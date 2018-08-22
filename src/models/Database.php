<?php

require 'vendor/autoload.php';

class Database {

	public function execute($sql){
		$objApplication = new Application();
		$arrConDetails = $objApplication->getDBDetails();

		$objAdapter = new Zend\Db\Adapter\Adapter($arrConDetails);

		$statement = $objAdapter->query($sql);

		$result = $statement->execute();

		return $result;
	}
}