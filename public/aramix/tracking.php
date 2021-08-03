<?php	
	$soapClient = new SoapClient('./tracking.wsdl');
	echo '<pre>';
	// shows the methods coming from the service 
	print_r($soapClient->__getFunctions());
	
	/*
		parameters needed for the trackShipments method , client info, Transaction, and Shipments' Numbers.
		Note: Shipments array can be more than one shipment.
	*/
	$params = array(
		'ClientInfo'  			=> array(
            'AccountCountryCode'	=> 'JO',
            'AccountEntity'		 	=> 'AMM',
            'AccountNumber'		 	=> '20016',
            'AccountPin'		 	=> '331421',
            'UserName'			 	=> 'testingapi@aramex.com',
            'Password'			 	=> 'R123456789$r',
            'Version'			 	=> 'v1.0'
        ),
		// 'ClientInfo'  			=> array(
        //     'AccountCountryCode'	=> 'SA',
        //     'AccountEntity'		 	=> 'RUH',
        //     'AccountNumber'		 	=> '60520854',
        //     'AccountPin'		 	=> '664165',
        //     'UserName'			 	=> 'Faresx3@gmail.com',
        //     'Password'			 	=> 'Naqshart123@',
        //     'Version'			 	=> 'v1.0'
        // ),

'Transaction' 			=> array(
            'Reference1'			=> '001'
        ),
		'Shipments'				=> array(
									'XXXXXXXXXX'
								)
	);
	
	// calling the method and printing results
	try {
		$auth_call = $soapClient->TrackShipments($params);
	} catch (SoapFault $fault) {
		die('Error : ' . $fault->faultstring);
	}
?>