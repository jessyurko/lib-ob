<?php

	$firstfield = "provider.name";
	$secondfield = "sourceResource.collection.title";
	$thirdfield = "sourceResource.format";


	// split around "|" characters to unwrap what we did in custom.js
	$search1 = ($_POST["search1"]);
	$search2 = ($_POST["search2"]);
	$search3 = ($_POST["search3"]);
	$qFormat = ($_POST["qFormat"]);


	$lim = 0;
	$page = $_POST["page"];
	$level = $_POST["level"];

	
	if($qFormat) $thirdfield = "q";



	$search1 = str_replace(" ", "%20", $search1);
	$search1 = str_replace('"', "%22", $search1);
	$search2 = str_replace(" ", "%20", $search2);
	$search2 = str_replace('"', "%22", $search2);
	$search3 = str_replace(" ", "%20", $search3);
	$search3 = str_replace('"', "%22", $search3);



	
	
	$url_display = "http://api.dp.la/v2/items?";
	if($level == 0) $url_display = $url_display . "facets=".$firstfield;
	if($level > 0) $url_display = $url_display . $firstfield."=". $search1;
	
	if($level == 1) $url_display = $url_display . "&facets=".$secondfield;
	if($level > 1) $url_display = $url_display . "&".$secondfield."=".$search2;
	
	if($level == 2) $url_display = $url_display . "&facets=".$thirdfield;
	if($level > 2) {
		$url_display = $url_display . "&".$thirdfield."=".$search3;
		$lim = 100;
	}
	
	$url_display = $url_display . "&page_size=".$lim."&page=".$page;
	$url_full = $url_display . "&api_key=cbb27864d49127519ea744deca8744e0";
	
	// perform the API request and catch the result
	$json_response = file_get_contents($url_full,0,null,null);
	
	// encode the result of the API call back to our waiting handler in custom.js 
	$array = array();
	$array["query"] = $url_display;
	$array["results"] = $json_response;
	echo(json_encode($array));

?>