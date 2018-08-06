<?php

use Zend\Db;

require 'vendor/autoload.php';
//require 'models/Application.php';

class Database {
	public $objConnection;

	public function __construct(){
		$objApplication = new Application();
		$arrConDetails = $objApplication->getDBDetails();

		$objAdapter = new Zend\Db\Adapter\Adapter($arrConDetails);

		/*$statement = $objAdapter->query('select * from users');
		$result = $statement->execute();
		$row = $result->current();
		var_dump($row);
		$result->next();
		$row = $result->current();
		var_dump($row);*/
	}
}