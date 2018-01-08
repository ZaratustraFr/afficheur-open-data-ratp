<?php

$station_name = $_POST["station_name"];
$id = $_GET["id"];

header('Content-Type: application/json');
$client = new SoapClient("wsiv.wsdl");

$request = array(
			'station' => array(
				'name' => '*'.$station_name.'*',
				'line' => array(
					'id' => $id
				)	
			)
		);
		
$stations_requested = $client->getStations($request);

$stations_requested = (array)$stations_requested->return->stations;
//print_r($lines_requested);

$stations_arr = array();

for ($i=0;$i<sizeof($stations_requested);$i++) {
	$stations_arr[$i]['name'] = $stations_requested[$i]->name;
}

echo json_encode(array_slice(array_values($stations_arr), 0, 20));
		
		
?>