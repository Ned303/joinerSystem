<?php

use Zend\Db;

require 'vendor/autoload.php';
require 'Application.php';

class Database {
	public $objAdapter = null;

	public function __construct(){
		$objApplication = new Application();
		$arrConDetails = $objApplication->getDBDetails();

		$objAdapter = new Zend\Db\Adapter\Adapter($arrConDetails);
	}

	public function execute($sql){
		$statement = $this->$objAdapter->query($sql);
		$result = $statement->execute();
		return $result;
	}
}