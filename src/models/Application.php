<?php

use Zend\Config\Factory;

require 'vendor/autoload.php';

class Application {
	public function getEmailConf(){

		$objConfig = Factory::fromFiles(glob('config.ini'));

		return $objConfig['email'];
	}

	public function getDBDetails(){
		$objConfig = Factory::fromFiles(glob('config.ini'));

		return $objConfig['database'];
	}
}