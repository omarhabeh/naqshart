<?php
    if ( isset($_GET['length'])){
        if ($_GET['length'] >= 1){
   

	$params = array(
		'ClientInfo'  			=> array(
									'AccountCountryCode'	=> 'SA',
									'AccountEntity'		 	=> 'RUH',
									'AccountNumber'		 	=> '60520854',
									'AccountPin'		 	=> '664165',
									'UserName'			 	=> 'Faresx3@gmail.com',
									'Password'			 	=> 'Naqshart123@',
									'Version'			 	=> 'v1.0'
								),

		'Transaction' 			=> array(
									'Reference1'			=> '001'
								),

		'OriginAddress' 	 	=> array(
									'City'					=> 'Riyadh',
									'CountryCode'				=> 'SA'
								),

		'DestinationAddress' 	=> array(
									'City'					=> $_GET['city'],
									'CountryCode'			=> $_GET['countryCode']
								),
		'ShipmentDetails'		=> array(
									'PaymentType'			 => 'P',
									'ProductGroup'			 => $_GET['countryCode'] == 'SA' ?'DOM': 'EXP',
									'ProductType'			 => $_GET['countryCode'] == 'SA' ?'CDS': 'EPX',
									'ActualWeight' 			 => array('Value' => 0.5 * $_GET['length'], 'Unit' => 'KG'),
									'ChargeableWeight' 	     => array('Value' => 0.5 * $_GET['length'], 'Unit' => 'KG'),
									'NumberOfPieces'		 => $_GET['length']
								)
	);
	$soapClient = new SoapClient('./Service_1_0.wsdl', array('trace' => 1,'exceptions' => 1,));
	$results = $soapClient->CalculateRate($params);

    $results = json_encode($results);
	print_r($results);
    }
}
?>
