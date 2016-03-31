<?php
/**
 * Developer:   Andrea Civita
 * Web-site:    http://www.andreacivita.it
 * GitHub:      https://github.com/andreacivita/
 */
class Application_Service_Functions
{

    public function __construct()
    {
    }
    
    public function calcolaEta($dataNascita)
    {
    	$oggi = new Zend_Date();
		$data = new Zend_Date($dataNascita);
        $anni = $oggi->toString('Y') - $data->toString('Y');
		
		if(strcmp($data->toString('M'), $oggi->toString('M')) < 0) return $anni+1;
		if(strcmp($data->toString('M'), $oggi->toString('M')) > 0) return $anni;
		else {
			if(strcmp($data->toString('D'), $oggi->toString('D')) <= 0) return $anni+1;
			else return $anni;
		}
    }
}