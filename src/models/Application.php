<?php

	use Zend\Config\Factory;

	class Application
	{
		public function getEmailConf()
		{

			$objConfig = Factory::fromFiles(glob('/var/www/joinerSystem/config.ini'));

			return $objConfig['email'];
		}

		public function getDBDetails()
		{
			$objConfig = Factory::fromFiles(glob('/var/www/joinerSystem/config.ini'));

			return $objConfig['database'];
		}

		public function getLocalUrl()
		{
			$objConfig = Factory::fromFiles(glob('/var/www/joinerSystem/config.ini'));

			return $objConfig['local']['url'];
		}

		public function getLogLocation() {
			$objConfig = Factory::fromFiles(glob('/var/www/joinerSystem/config.ini'));

			return $objConfig['log']['error']['filepath'];
		}
	}