<?php

require('scraper.php');


$url = "http://www.elko.is/elko/is/vorur/Fartolvur.ecl";
$results_page = curl($url);

$results_page = scrape_between($results_page, "<div id=\"ecshop_product_container\"", "<div id=\"ecshop_bottom_paging\"");

$separate_results = explode("<div class=\"item-list\">", $results_page);

$items = [
	"laptops" => []
];

$itemNumber = 0;
     
// For each separate result, scrape the URL
foreach ($separate_results as $separate_result) {
    if (trim($separate_result) != "") {
    	$name = scrape_between($separate_result, " title=\"Smelltu hér til að skoða ", "\"");
    	if(trim($name) != ""){

    		$specs = [
    			"url" => "",
				"name" => "",
				"price" => "",
				"manufacturer" => "",
				"os" => "",
				"cpu" => [
					"type" => "",
					"family" => "",
					"id" => "",
					"cores" => "",
					"clockspeed" => "",
					"cache" => "",
					"turbo" => ""
				],
				"ram" => [
					"type" => "",
					"size" => "",
					"clockspeed" => ""
				],
				"storage" => [
					"size" => "",
					"type" => "",
					"rpm" => "",
					"ssd" => "",
					"ssd_size" => ""
				],
				"soundgraphic" => [
					"soundcard" => "",
					"gpu" => "",
					"vram" => ""
				],
				"screen" => [
					"type" => "",
					"size" => "",
					"resolution" => "",
					"touchscreen" => "",
					"webcam" => "",
					"webcam_resolution" => ""
				],
				"io" => [
					"network_adapter" => "",
					"wireless_adapter" => "",
					"hdmi" => "",
					"vga" => "",
					"dvi" => "",
					"usb2" => "",
					"usb3" => "",
					"bluetooth" => "",
					"thunderbolt" => "",
					"mini_displayport" => "",
					"headphone_mic" => ""
				],
				"battery" => [
					"type" => "",
					"size" => "",
					"duration" => ""
				],
				"other" => [
					"cd_drive" => "",
					"cd_drive-type" => "",
					"card_reader" => "",
					"keyboard" => "",
					"icelandic_letters" => "",
					"software" => "",
					"other" => ""
				],
				"appearance" => [
					"color" => "",
					"dimensions" => "",
					"weight" => ""
				]
			];

    		// Get Item
        	$newItem = scrape_between($separate_result, "<div class=\"product_image\">", "</div>");
        	// Get URL from Item
        	$newUrl = "http://www.elko.is" . scrape_between($newItem, "href=\"", "\">");

        	// Laptop name
        	$shorterName = explode("tölva", $name);

        	$name = str_replace("far","",$shorterName[0]);

        	$specs["name"] = trim($name);
        	$specs["url"] = $newUrl;

        	// cURL it
        	$itemPage = curl($newUrl);
        	// Get price
        	$itemPrice = scrape_between($itemPage, "itemprop=\"discount-price\">", "</span>");
        	$itemPrice = str_replace("kr", "", $itemPrice);
        	$itemPrice = str_replace(".", "", $itemPrice);
        	$itemPrice = intval(trim($itemPrice));

        	if($itemPrice <= 0){
        		$itemPrice = scrape_between($itemPage, "itemprop=\"original-price\">", "</span>");
	        	$itemPrice = str_replace("kr", "", $itemPrice);
	        	$itemPrice = str_replace(".", "", $itemPrice);
	        	$itemPrice = intval(trim($itemPrice));
        	}

        	$itemPrice = number_format($itemPrice, 0, ',', '.');
        	$specs["price"] = $itemPrice;
        	// Get area of scraping
        	$itemSpecs = scrape_between($itemPage, "<div id=\"specs\" class=\"tab-pane\">", "<div id=\"customer-overview\"");
        	// Explode area
        	$separate_specs = explode("<tr class=\"product_property\">", $itemSpecs);

        	// Specs array
        	$elkoSpecs = [
		    	"header" => [],
		    	"key" => []
		    ];

		    // Populate specs array
		    foreach ($separate_specs as $key) {
		    	if(trim($key) != ""){
		    		array_push($elkoSpecs["header"], scrape_between($key, "<td class=\"product_property_name\">", "</td>"));
		    		array_push($elkoSpecs["key"], scrape_between($key, "<td class=\"product_property_value\">", "</td>"));
		    	}
		    }

		    // Populate global laptop array
		    for ($i=0; $i < count($elkoSpecs["header"]); $i++) {
		    	switch ($elkoSpecs["header"][$i]) {
		    		case 'Framleiðandi':
		    			$specs["manufacturer"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Stýrikerfi':
		    			$specs["os"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Örgjörvi':
		    			$cpuSpecs = explode(" ", $elkoSpecs["key"][$i]);
		    			if($cpuSpecs[0] == "Intel"){
		    				$specs["cpu"]["type"] = $cpuSpecs[0];

		    				if(strpos($elkoSpecs["key"][$i], 'Core') !== FALSE){
		    					$specs["cpu"]["family"] = $cpuSpecs[2];
		    				}
		    				else{
		    					$specs["cpu"]["family"] = $cpuSpecs[1];
		    				}
		    			}
		    			else if($cpuSpecs[0] == "AMD"){
		    				$specs["cpu"]["type"] = $cpuSpecs[0];
		    			}
		    			else{
		    				$specs["cpu"]["family"] = $elkoSpecs["key"][$i];
		    			}
		    			
		    			break;

		    		case 'Númer örgjörva':
		    			if($specs["cpu"]["type"] == "AMD"){
		    				$cpuSpecs = explode("-", $elkoSpecs["key"][$i]);

		    				$specs["cpu"]["family"] = $cpuSpecs[0];
		    				$specs["cpu"]["id"] = $cpuSpecs[1];
		    			}
		    			else{
		    				if(strpos($elkoSpecs["key"][$i], '-') !== FALSE){
		    					$cpuSpecs = explode("-", $elkoSpecs["key"][$i]);

		    					$specs["cpu"]["id"] = $cpuSpecs[1];
		    				}
		    				else if(strpos($elkoSpecs["key"][$i], ' ') !== FALSE){
		    					$cpuSpecs = explode(" ", $elkoSpecs["key"][$i]);

		    					$specs["cpu"]["id"] = $cpuSpecs[1];
		    				}
		    				else{
		    					$specs["cpu"]["id"] = $elkoSpecs["key"][$i];
		    				}
		    			}
		    			break;

		    		case 'Fjöldi kjarna (Core)':
		    			if(strpos($elkoSpecs["key"][$i], 'Dual') !== FALSE){
		    				$specs["cpu"]["cores"] = "2";
		    			}
		    			else if(strpos($elkoSpecs["key"][$i], 'Quad') !== FALSE){
		    				$specs["cpu"]["cores"] = "4";
		    			}
		    			else{
		    				$specs["cpu"]["cores"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Hraði örgjörva (GHz)':
		    			$clockspeed = str_replace(" ","",$elkoSpecs["key"][$i]);
		    			$clockspeed = str_replace(",",".",$clockspeed);

		    			$specs["cpu"]["clockspeed"] = $clockspeed;
		    			break;

		    		case 'Hraði með Turbo Boost':
		    			$specs["cpu"]["turbo"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'CPU Cache':
		    			if(!empty($elkoSpecs["key"][$i])){
		    				$specs["cpu"]["cache"] = $elkoSpecs["key"][$i][0];
		    			}
		    			else{
		    				$specs["cpu"]["cache"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Gerð vinnsluminnis':
		    			$specs["ram"]["type"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Vinnsluminni (GB)':
		    			$specs["ram"]["size"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Hraði vinnsluminnis (MHz)':
		    			$clockspeed = str_replace(" ","",$elkoSpecs["key"][$i]);

		    			$specs["ram"]["clockspeed"] = $clockspeed;
		    			break;

		    		case 'Harður diskur (GB)':
		    			$gb = explode(" ", $elkoSpecs["key"][$i]);

		    			/*$gb = str_replace("GB","",$elkoSpecs["key"][$i]);
		    			$gb = str_replace("SSD","",$gb);
		    			$gb = str_replace("SSHD","",$gb);
		    			$gb = str_replace("Flash","",$gb);*/

		    			$specs["storage"]["size"] = trim($gb[0]);
		    			break;

		    		case 'Gerð harðadisks':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), '8gb cache') !== FALSE){
		    				$specs["storage"]["type"] = "SSHD";
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'sata') !== FALSE){
		    				$specs["storage"]["type"] = "SATA";
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'sshd') !== FALSE){
		    				$specs["storage"]["type"] = "SSHD";
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'ssd') !== FALSE){
		    				$specs["storage"]["type"] = "SSD";
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'flash') !== FALSE){
		    				$specs["storage"]["type"] = "Flash";
		    			}
		    			else{
		    				$specs["storage"]["type"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Snúningshraði disks':
		    			$specs["storage"]["rpm"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Solid State Drive (SSD)':
		    			if($elkoSpecs["key"][$i] == "Já"){
		    				$specs["storage"]["type"] = "SSD";
		    			}

		    			$specs["storage"]["ssd"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'SSD (GB)':
		    			$specs["storage"]["ssd_size"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Hljóðkort':
		    			$specs["soundgraphic"]["soundcard"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Skjákort':
		    			$specs["soundgraphic"]["gpu"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Vinnsluminni skjákorts':
		    			$specs["soundgraphic"]["vram"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Skjágerð':
		    			if(strpos($elkoSpecs["key"][$i], 'Retina') !== FALSE){
		    				$specs["screen"]["type"] = "Retina";
		    			}
		    			else if(strpos($elkoSpecs["key"][$i], 'TN') !== FALSE){
		    				$specs["screen"]["type"] = "TN";
		    			}
		    			else if(strpos($elkoSpecs["key"][$i], 'IPS') !== FALSE){
		    				$specs["screen"]["type"] = "IPS";
		    			}
		    			else if(strpos($elkoSpecs["key"][$i], 'VA') !== FALSE){
		    				$specs["screen"]["type"] = "VA";
		    			}
		    			else if(strpos($elkoSpecs["key"][$i], 'LED') !== FALSE){
		    				$specs["screen"]["type"] = "LED";
		    			}
		    			else{
		    				$specs["screen"]["type"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Skjástærð':
		    			$inches = str_replace("'","",$elkoSpecs["key"][$i]);
		    			$inches = str_replace("\"","",$inches);
		    			$inches = str_replace(",",".",$inches);

		    			$specs["screen"]["size"] = $inches;
		    			break;

		    		case 'Upplausn':
		    			$resolution = str_replace(" ","",$elkoSpecs["key"][$i]);
		    			$resolution = str_replace(",","x",$resolution);

		    			$specs["screen"]["resolution"] = $resolution;
		    			break;

		    		case 'Snertiskjár':
		    			$specs["screen"]["touchscreen"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Vefmyndavél':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["screen"]["webcam"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["screen"]["webcam"] = 0;
		    			}
		    			else{
		    				$specs["screen"]["webcam"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Vefmyndavél - upplausn':
		    			if(strpos($elkoSpecs["key"][$i], '720') !== FALSE){
		    				$specs["screen"]["webcam_resolution"] = "720p";
		    			}
		    			else if(strpos($elkoSpecs["key"][$i], '1080') !== FALSE){
		    				$specs["screen"]["webcam_resolution"] = "1080p";
		    			}
		    			else if(strpos($elkoSpecs["key"][$i], 'IPS') !== FALSE){
		    				$specs["screen"]["type"] = "IPS";
		    			}
		    			else if(strpos($elkoSpecs["key"][$i], 'VA') !== FALSE){
		    				$specs["screen"]["type"] = "VA";
		    			}
		    			else if(strpos($elkoSpecs["key"][$i], 'LED') !== FALSE){
		    				$specs["screen"]["type"] = "LED";
		    			}
		    			else{
		    				$specs["screen"]["webcam_resolution"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Gerð netkorts':
		    			$specs["io"]["network_adapter"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Þráðlaust netkort':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["io"]["wireless_adapter"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["io"]["wireless_adapter"] = 0;
		    			}
		    			else{
		    				$specs["io"]["wireless_adapter"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'HDMI út':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["io"]["hdmi"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["io"]["hdmi"] = 0;
		    			}
		    			else{
		    				$specs["io"]["hdmi"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'VGA':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["io"]["vga"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["io"]["vga"] = 0;
		    			}
		    			else{
		    				$specs["io"]["vga"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'DVI':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["io"]["dvi"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["io"]["dvi"] = 0;
		    			}
		    			else{
		    				$specs["io"]["dvi"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'USB 2.0':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["io"]["usb2"] = 0;
		    			}
		    			else{
		    				$specs["io"]["usb2"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'USB 3.0':
		    			$specs["io"]["usb3"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Bluetooth':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["io"]["bluetooth"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["io"]["bluetooth"] = 0;
		    			}
		    			else{
		    				$specs["io"]["bluetooth"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Thunderbolt':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["io"]["thunderbolt"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["io"]["thunderbolt"] = 0;
		    			}
		    			else{
		    				$specs["io"]["thunderbolt"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'MiniDisplay Port':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["io"]["mini_displayport"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["io"]["mini_displayport"] = 0;
		    			}
		    			else{
		    				$specs["io"]["mini_displayport"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Tengi fyrir heyrnartól/hljóðnema':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["io"]["headphone_mic"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["io"]["headphone_mic"] = 0;
		    			}
		    			else{
		    				$specs["io"]["headphone_mic"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Rafhlaða':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'ion') !== FALSE){
		    				$specs["battery"]["type"] = "lithium-ion";
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'po') !== FALSE){
		    				$specs["battery"]["type"] = "lithium-polymer";
		    			}
		    			else{
		    				$specs["battery"]["type"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Rafhlöðuending':
		    			$specs["battery"]["duration"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Tæknilegar upplýsingar um rafhlöðu':
		    			$specs["battery"]["size"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Geisladrif':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["other"]["cd_drive"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["other"]["cd_drive"] = 0;
		    			}
		    			else{
		    				$specs["other"]["cd_drive"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'CD/DVD/DVD+R/RW/BD':
		    			$specs["other"]["cd_drive-type"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Minniskortalesari':
		    			if(strpos(strtolower($elkoSpecs["key"][$i]), 'já') !== FALSE){
		    				$specs["other"]["card_reader"] = 1;
		    			}
		    			else if(strpos(strtolower($elkoSpecs["key"][$i]), 'nei') !== FALSE){
		    				$specs["other"]["card_reader"] = 0;
		    			}
		    			else{
		    				$specs["other"]["card_reader"] = $elkoSpecs["key"][$i];
		    			}
		    			break;

		    		case 'Lyklaborð':
		    			$specs["other"]["keyboard"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Íslenskir stafir á lyklaborði':
		    			$specs["other"]["icelandic_letters"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Forrit sem fylgja':
		    			$specs["other"]["software"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Annað':
		    			$specs["other"]["other"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Litur':
		    			$specs["appearance"]["color"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Stærð (HxBxD)':
		    			$specs["appearance"]["dimensions"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Þyngd (kg)':
		    			$weigth = trim($elkoSpecs["key"][$i]);

		    			if($elkoSpecs["key"][$i]){
		    				$weigth = str_replace(",", ".", $weigth);
		    			}

		    			$specs["appearance"]["weight"] = $weigth;
		    			break;
		    		
		    		default:
		    			break;
		    	}
		    }

		    array_push($items["laptops"], $specs);
		    $itemNumber++;
    	}
    	
    }
    /*if($itemNumber > 2){
    	break;
    }*/
    sleep(1);
}

/*echo "<pre>";
print_r($items); // Printing out our array of URLs we've just scraped
echo "</pre>";*/

file_put_contents('../data/elko.json', json_encode($items));