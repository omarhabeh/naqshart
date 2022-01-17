<?php
	$soapClient = new SoapClient('./cities.wsdl', array('trace' => 1,'exceptions' => 1,));


	$params = array(
		'ClientInfo'  			=> array(
									'AccountCountryCode'		=> 'JO',
									'AccountEntity'		 	=> 'AMM',
									'AccountNumber'		 	=> '20016',
									'AccountPin'		 	=> '331421',
									'UserName'			=> 'testingapi@aramex.com',
									'Password'		 	=> 'R123456789$r',
									'Version'		 	=> 'v1.0',
									'Source' 			=> NULL
								),

		'Transaction' 			=> array(
									'Reference1'			=> '001',
									'Reference2'			=> '002',
									'Reference3'			=> '003',
									'Reference4'			=> '004',
									'Reference5'			=> '005'

								),
		'CountryCode'			=> $_GET['country'],

		);

	// calling the method and printing results
	try {
		$auth_call = $soapClient->FetchCities($params);

		$results = json_encode($auth_call);
	    print_r($results);
		die();

	} catch (SoapFault $fault) {
		die('Error : ' . $fault->faultstring);
	}
?>
