<?php
ini_set('max_execution_time', 3000);
require('scraper/scraper.php');

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
	<?php

		$url = "http://www.elko.is/elko/is/vorur/Fartolvur.ecl";    // Assigning the URL we want to scrape to the variable $url
	    $results_page = curl($url); // Downloading the results page using our curl() funtion
	    
	    $results_page = scrape_between($results_page, "<div id=\"ecshop_product_container\"", "<div id=\"ecshop_bottom_paging\""); // Scraping out only the middle section of the results page that contains our results

	    $separate_results = explode("<div class=\"item-list\">", $results_page);   // Expploding the results into separate parts into an array

	    $items = [
	    	"laptops" => [
	    		"name" => [],
	    		"manufacturer" => [],
	    		"os" => [],
	    		"cpu" => [
	    			"family" => [],
	    			"id" => [],
	    			"cores" => [],
	    			"clockspeed" => [],
	    			"turbo" => [],
	    			"cache" => []
	    		],
	    		"ram" => [
	    			"type" => [],
	    			"size" => [],
	    			"clockspeed" => [],
	    			"expandability" => []
	    		],
	    		"storage" => [
	    			"size" => [],
	    			"type" => [],
	    			"rpm" => [],
	    			"ssd" => [],
	    			"ssd-size" => []
	    		],
	    		"soundgraphic" => [
	    			"soundcard" => [],
	    			"gpu" => [],
	    			"vram" => []
	    		],
	    		"screen" => [
	    			"type" => [],
	    			"size" => [],
	    			"resolution" => [],
	    			"touchscreen" => [],
	    			"webcam" => [],
	    			"webcam-resolution" => []
	    		],
	    		"io" => [
	    			"network-adapter" => [],
	    			"wireless-adapter" => [],
	    			"widi" => [],
	    			"hdmi" => [],
	    			"vga" => [],
	    			"dvi" => [],
	    			"usb2" => [],
	    			"usb3" => [],
	    			"bluetooth" => [],
	    			"bluetooth-version" => [],
	    			"thunderbolt" => [],
	    			"mini-displayport" => [],
	    			"headphone-mic" => []
	    		],
	    		"battery" => [
	    			"type" => [],
	    			"size" => [],
	    			"duration" => []
	    		],
	    		"other" => [
	    			"cd-drive" => [],
	    			"cd-drive-type" => [],
	    			"card-reader" => [],
	    			"keyboard" => [],
	    			"icelandic-letters" => [],
	    			"software" => [],
	    			"other" => []
	    		],
	    		"appearance" => [
	    			"color" => [],
	    			"dimensions" => [],
	    			"weight" => []
	    		]
	    	]
	    ];

	    $itemNumber = 0;
	         
	    // For each separate result, scrape the URL
	    foreach ($separate_results as $separate_result) {
	        if (trim($separate_result) != "") {
	        	$name = scrape_between($separate_result, " title=\"Smelltu hér til að skoða ", "\"");
	        	if(trim($name) != ""){
	        		// Get Item
		        	$newItem = scrape_between($separate_result, "<div class=\"product_image\">", "</div>");
		        	// Get URL from Item
		        	$newUrl = "http://www.elko.is" . scrape_between($newItem, "href=\"", "\">");

		        	// Laptop name
		        	$items["laptops"]["name"][$itemNumber] = $name;

		        	// cURL it
		        	$itemPage = curl($newUrl);
		        	// Get area of scraping
		        	$itemSpecs = scrape_between($itemPage, "<div id=\"specs\" class=\"tab-pane\">", "<div id=\"customer-overview\"");
		        	// Explode area
		        	$separate_specs = explode("<tr class=\"product_property\">", $itemPage);

		        	// Specs array
		        	$specs = [
				    	"header" => [],
				    	"key" => []
				    ];

				    // Populate specs array
				    foreach ($separate_specs as $key) {
				    	if(trim($key) != ""){
				    		array_push($specs["header"], scrape_between($key, "<td class=\"product_property_name\">", "</td>"));
				    		array_push($specs["key"], scrape_between($key, "<td class=\"product_property_value\">", "</td>"));
				    	}
				    }

				    // Populate global laptop array
				    for ($i=0; $i < count($specs["header"]); $i++) {
				    	switch ($specs["header"][$i]) {
				    		case 'Framleiðandi':
				    			$items["laptops"]["manufacturer"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Stýrikerfi':
				    			$items["laptops"]["os"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Örgjörvi':
				    			$items["laptops"]["cpu"]["family"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Númer örgjörva':
				    			$items["laptops"]["cpu"]["id"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Fjöldi kjarna (Core)':
				    			$items["laptops"]["cpu"]["cores"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Hraði örgjörva (GHz)':
				    			$items["laptops"]["cpu"]["clockspeed"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Hraði með Turbo Boost':
				    			$items["laptops"]["cpu"]["turbo"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'CPU Cache':
				    			$items["laptops"]["cpu"]["cache"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Gerð vinnsluminnis':
				    			$items["laptops"]["ram"]["type"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Vinnsluminni (GB)':
				    			$items["laptops"]["ram"]["size"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Hraði vinnsluminnis (MHz)':
				    			$items["laptops"]["ram"]["clockspeed"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Hægt að stækka minni (GB)':
				    			$items["laptops"]["ram"]["expandability"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Harður diskur (GB)':
				    			$items["laptops"]["storage"]["size"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Gerð harðadisks':
				    			$items["laptops"]["storage"]["type"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Snúningshraði disks':
				    			$items["laptops"]["storage"]["rpm"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Solid State Drive (SSD)':
				    			$items["laptops"]["storage"]["ssd"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'SSD (GB)':
				    			$items["laptops"]["storage"]["ssd-size"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Hljóðkort':
				    			$items["laptops"]["soundgraphic"]["soundcard"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Skjákort':
				    			$items["laptops"]["soundgraphic"]["gpu"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Vinnsluminni skjákorts':
				    			$items["laptops"]["soundgraphic"]["vram"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Skjágerð':
				    			$items["laptops"]["screen"]["type"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Skjástærð':
				    			$items["laptops"]["screen"]["size"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Upplausn':
				    			$items["laptops"]["screen"]["resolution"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Snertiskjár':
				    			$items["laptops"]["screen"]["touchscreen"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Vefmyndavél':
				    			$items["laptops"]["screen"]["webcam"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Vefmyndavél - upplausn':
				    			$items["laptops"]["screen"]["webcam-resolution"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Gerð netkorts':
				    			$items["laptops"]["io"]["network-adapter"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Þráðlaust netkort':
				    			$items["laptops"]["io"]["wireless-adapter"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'WiDi (Intel Wireless Display)':
				    			$items["laptops"]["io"]["widi"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'HDMI út':
				    			$items["laptops"]["io"]["hdmi"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'VGA':
				    			$items["laptops"]["io"]["vga"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'DVI':
				    			$items["laptops"]["io"]["dvi"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'USB 2.0':
				    			$items["laptops"]["io"]["usb2"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'USB 3.0':
				    			$items["laptops"]["io"]["usb3"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Bluetooth':
				    			$items["laptops"]["io"]["bluetooth"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Bluetooth tækniupplýsingar':
				    			$items["laptops"]["io"]["bluetooth-version"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Thunderbolt':
				    			$items["laptops"]["io"]["thunderbolt"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'MiniDisplay Port':
				    			$items["laptops"]["io"]["mini-displayport"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Tengi fyrir heyrnartól/hljóðnema':
				    			$items["laptops"]["io"]["headphone-mic"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Rafhlaða':
				    			$items["laptops"]["battery"]["type"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Rafhlöðuending':
				    			$items["laptops"]["battery"]["duration"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Tæknilegar upplýsingar um rafhlöðu':
				    			$items["laptops"]["battery"]["size"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Geisladrif':
				    			$items["laptops"]["other"]["cd-drive"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'CD/DVD/DVD+R/RW/BD':
				    			$items["laptops"]["other"]["cd-drive-type"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Minniskortalesari':
				    			$items["laptops"]["other"]["card-reader"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Lyklaborð':
				    			$items["laptops"]["other"]["keyboard"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Íslenskir stafir á lyklaborði':
				    			$items["laptops"]["other"]["icelandic-letters"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Forrit sem fylgja':
				    			$items["laptops"]["other"]["software"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Annað':
				    			$items["laptops"]["other"]["other"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Litur':
				    			$items["laptops"]["appearance"]["color"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Stærð (HxBxD)':
				    			$items["laptops"]["appearance"]["dimensions"][$itemNumber] = $specs["key"][$i];
				    			break;

				    		case 'Þyngd (kg)':
				    			$items["laptops"]["appearance"]["weight"][$itemNumber] = $specs["key"][$i];
				    			break;
				    		
				    		default:
				    			break;
				    	}
				    }
				    // Increment
				    $itemNumber++;
	        	}
	        	
	        }
	        //if($cake == 4) break;
	        sleep(1);
	    }

	    echo "<pre>";
	    print_r($items); // Printing out our array of URLs we've just scraped
	    echo "</pre>";

	    //echo $separate_results[5];

	?>
</body>

</html> 