<?php
date_default_timezone_set('Europe/Paris');
header('Content-Type: application/json');


$missions_to_catch = '2';
$station_name = $_GET["station_name"];
$code = $_GET["code"];
$date = date("H:i");




function getLine($line_code) {
	$client = new SoapClient("wsiv.wsdl");
	$date = date("H:i");
	$request = array(
			'line' => array(
				'code' => $line_code,
				'reseau' => array(
					'code' => '*'
				)
			)
		);
	$line_requested = $client->getLines($request);
	//print_r($line_requested);
	$line_requested = (array)$line_requested->return;
	if(!isset($line_requested[0])) {
		$line[0]['id']   = $line_requested['id'];
		$line[0]['code'] = $line_requested['code'];
	} else {
		$tok = 0;
		for($i=0;$i<sizeof($line_requested);$i++) {
			if( ($line_requested[$i]->reseau->code=='busratp') || ($line_requested[$i]->reseau->code=='rer')) {
				$line[$tok]['id']	= $line_requested[$i]->id;
				$line[$tok]['code']	= $line_requested[$i]->code;
				$line[$tok]['reseau']	= $line_requested[$i]->reseau->code;
				$line[$tok]['date']	= $date;
				$tok++;
			}
		}
	}
	//print_r($line);
	return($line);
}

function getDirections($id) {
	$client = new SoapClient("wsiv.wsdl");
	$request = array(
				'line' => array(
					'id' => $id
				)
			);	
	$directions = (array)$client->getDirections($request)->return->directions;
	//print_r($directions);
	if(!isset($directions[0])) {
		$retour[0]['name'] = $directions['name'];
		$retour[0]['sens'] = $directions['sens'];
		$retour[0]['obj'] =  $directions;
		
	} else {
		for($i=0;$i<sizeof($directions);$i++) {
			$retour[$i]['name']	= $directions[$i]->name;
			$retour[$i]['sens']	= $directions[$i]->sens;
			$retour[$i]['obj'] =  $directions[$i];
		}
	}
	//print_r($retour);
	return($retour);
}

function getStations($id,$station_name) {
	$client = new SoapClient("wsiv.wsdl");
	$request = array(
				'station' => array(
					'name' => '*'.$station_name.'*',
					'line' => array(
						'id' => $id
					)	
				)
			);
	$station_requested = $client->getStations($request);
	//print_r($station_requested);
	if(!isset($station_requested)) {
		$station_requested = 0;
	}
	else {
		//si on ne recupere qu'une seule station
		if (!is_array($station_requested->return->stations)) {
			$station['id'] = strval($station_requested->return->stations->id);
			$station[0]['id'] = strval($station_requested->return->stations->geoPointA->id);
			$station[0]['station'] = (array)$station_requested->return->stations;
			if ($station_requested->return->stations->geoPointR) {
				$station[1]['id'] = strval($station_requested->return->stations->geoPointR->id);
				$station[1]['station'] = (array)$station_requested->return->stations;
			}
			else {
				$station[1]['id'] = '';
				$station[1]['station'] = '';
			}
		} else {
			$station['id'] = strval($station_requested->return->stations[0]->id);
			$station[0]['id'] = strval($station_requested->return->stations[0]->geoPointA->id);
			$station[0]['station'] = (array)$station_requested->return->stations[0];
			if ($station_requested->return->stations[0]->geoPointR) {
				$station[1]['id'] = strval($station_requested->return->stations[0]->geoPointR->id);
				$station[1]['station'] = (array)$station_requested->return->stations[0];
			}
			else {
				$station[1]['id'] = '';
				$station[1]['station'] = '';
			}
		}
	}
	//print_r($station);
	return($station);
}

function getMissionNext($station_id, $direction, $station, $sens) {
	$client = new SoapClient("wsiv.wsdl");
	$request = array(
				'station' => $station,
				'direction' => array(
					'sens' => $sens
					),
				'limit' => '4',
				//'dateStart' => '201711281149'
				);	
	//print_r($request);
	$next_missions = (array)$client->getMissionsNext($request);
	//print_r($next_missions);
	$next_missions = $next_missions['return']->missions;
	$nb = 0;
	if(!is_array($next_missions)) {
		$mission = $next_missions;
		//print_r("là------------");
		if(substr($mission->stationsDates[0],-4)-date("Hi")>=0) {
			$retour[$nb]['time'] = substr($mission->stationsDates[0],-4);
			$retour[$nb]['time_fmt'] = substr($mission->stationsDates[0],-4,2).':'.substr($mission->stationsDates[0],-2,2);
			$retour[$nb]['time_str'] = substr($mission->stationsDates[0],-4)-date("Hi").' min';
			$retour[$nb]['end'] = $mission->stations[1]->name;
		}
		//print_r("ici------------");
	} else {
		for($i=0;$i<sizeof($next_missions);$i++) {
			$mission = $next_missions[$i];
			//print_r($mission);
			if(substr($mission->stationsDates[0],-4)-date("Hi")>=0) {
				$retour[$nb]['time'] = substr($mission->stationsDates[0],-4);
				$retour[$nb]['time_fmt'] = substr($mission->stationsDates[0],-4,2).':'.substr($mission->stationsDates[0],-2,2);
				$retour[$nb]['time_str'] = substr($mission->stationsDates[0],-4)-date("Hi").' min';
				$retour[$nb]['end'] = $mission->stations[1]->name;
				$nb++;
			}
			//print_r($retour);
		}
	}
	//print_r($retour);
	return($retour);
}
/*
function orderByTime($line) {
	($myArray, function($a, $b) {
    return $a['order'] - $b['order'];
});
}
*/
$line = getLine($code);
//print_r($line);
for($i=0;$i<sizeof($line);$i++) {
	$line[$i]['directions'] = getDirections($line[$i]['id']);
	//print_r($line[$i]);
	if(isset($line[$i]['directions'])) {
		$line[$i]['station'] = getStations($line[$i]['id'], $station_name);
		for($j=0;$j<sizeof($line[$i]['directions']);$j++) {
			if($line[$i]['directions'][$j]['sens'] == 'A' ) {
				$line[$i]['directions'][$j]['station_id'] = $line[$i]['station'][0]['id'];
				$line[$i]['directions'][$j]['station_name'] = $line[$i]['station'][0]['station']['name'];
				$line[$i]['directions'][$j]['station'] = $line[$i]['station'][0]['station'];
			}
			else {
				$line[$i]['directions'][$j]['station_id'] = $line[$i]['station'][1]['id'];
				$line[$i]['directions'][$j]['station_name'] = $line[$i]['station'][1]['station']['name'];
				$line[$i]['directions'][$j]['station'] = $line[$i]['station'][1]['station'];
			}
			//print_r($line[$i]);			
			//print_r("-----------------------");
			//print_r($i);
			
			if (isset( $line[$i]['directions'][$j]['station_id'])) {
				$line[$i]['directions'][$j]['next_missions'] = getMissionNext($line[$i]['directions'][$j]['station_id'], $line[$i]['directions'][$j]['sens'], $line[$i]['directions'][$j]['station'], $line[$i]['directions'][$j]['sens'] );
			}
			//print_r($i);
			//print_r("-----------------------");
			//print_r($line);
			
			if(isset($line[$i]['directions'][$j]['obj'])) unset($line[$i]['directions'][$j]['obj']);
			if(isset($line[$i]['directions'][$j]['station'])) unset($line[$i]['directions'][$j]['station']);
			
			//print_r($line[$i]);
		}
		if (isset($line[$i]['station'])) unset($line[$i]['station']);
		//print_r($line);
		//print_r("------------------------------------------------------------------");
	}
	//print_r($line[$i]);
}
//print_r("------------------------------------------------------------------");
//print_r($line);
// si on a detecte plus d'une ligne, c'est qu'il y a des partiels, du coup on va tout regroupe sur la ligne 0
if(sizeof($line)>1) {
	
	// on commence par blinder les index A et R de la premiere ligne
	$Aindex = -1;
	$Rindex = -1;
	for($j=0;$j<sizeof($line[0]['directions']);$j++) {
		if($line[0]['directions'][$j]['sens'] == 'A') $Aindex = $j;
		if($line[0]['directions'][$j]['sens'] == 'R') $Rindex = $j;
	}
	//print_r($line);
	// on copie dans la ligne 0 avec les bonnes directions
	for($i=1;$i<sizeof($line);$i++) {
		for($j=0;$j<sizeof($line[$i]['directions']);$j++) {
			for($k=0;$k<sizeof($line[$i]['directions'][$j]['next_missions']);$k++) {
				if($line[$i]['directions'][$j]['sens'] == 'A') $line[0]['directions'][$Aindex]['next_missions'][] = $line[$i]['directions'][$j]['next_missions'][$k];
				if($line[$i]['directions'][$j]['sens'] == 'R') $line[0]['directions'][$Rindex]['next_missions'][] = $line[$i]['directions'][$j]['next_missions'][$k];
			}
		}
	}
	//print_r($line);
	// on supprime les lignes en trop
	$line_tmp = $line[0];
	$line = ''; $line[0] = $line_tmp;
}
//print_r($line);

// Tri des passages par temps et pas par direction
for($j=0;$j<sizeof($line[0]['directions']);$j++) {
	
	usort($line[0]['directions'][$j]['next_missions'], function($a, $b) {
		return $a['time'] - $b['time'];
	});
}
//print_r($line);
// Suppression des doublons
for($j=0;$j<sizeof($line[0]['directions']);$j++) {
	$before = null;
	$to_unset = null;
	for($k=0;$k<sizeof($line[0]['directions'][$j]['next_missions']);$k++) {
		if($before!=null) {
			if($before==$line[0]['directions'][$j]['next_missions'][$k]['time']) {
				$to_unset[] = $k;
			}
		}
		$before = $line[0]['directions'][$j]['next_missions'][$k]['time'];
	}
	for($l=sizeof($to_unset)-1;$l>=0;$l--) {
		//unset($line[0]['directions'][$j]['next_missions'][$to_unset[$l]]);
		array_splice($line[0]['directions'][$j]['next_missions'], $to_unset[$l], 1);
	}	
}
//print_r($line);
echo json_encode($line[0], JSON_PRETTY_PRINT);

?>
