<?php

	use Zend\Log\Logger;
	use Zend\Log\Writer\Stream;

	class Log
	{
		public function getErrorLog(){
			$objApp = new Application();
			$logLocation = $objApp->getLogLocation();

			$logger = new Logger;
			$writer = new Stream($logLocation);

			$logger->addWriter($writer);

			return $logger;
		}
	}