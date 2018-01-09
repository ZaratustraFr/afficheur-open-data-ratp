<?php
$client = new SoapClient("wsiv.wsdl");
$code = $_POST["q"];

$request = array(
	'line' => array(
		'code' => $code.'*',
		'reseau' => array(
			'code' => '*'
		)
	)
);
$lines_requested = $client->getLines($request);
$lines_requested = (array)$lines_requested->return;

$lines_arr = array();
$indices_arr = array();
for ($i=0;$i<sizeof($lines_requested);$i++) {
	if( ($lines_requested[$i]->reseau->code=='busratp') || ($lines_requested[$i]->reseau->code=='rer') || ($lines_requested[$i]->reseau->code=='metro') || ($lines_requested[$i]->reseau->code=='noctilienratp') || ($lines_requested[$i]->reseau->code=='tram') ) {
		if (!in_array($lines_requested[$i]->code, $indices_arr)) {
			$indices_arr[] = $lines_requested[$i]->code;
			$lines_arr[$i]['code'] = $lines_requested[$i]->code;
			$lines_arr[$i]['id'] = $lines_requested[$i]->id;
			$lines_arr[$i]['name'] = $lines_requested[$i]->name;
			$lines_arr[$i]['reseau'] = $lines_requested[$i]->reseau->code;
		}
	}	
}

echo json_encode(array_slice(array_values($lines_arr), 0, 20));
?>