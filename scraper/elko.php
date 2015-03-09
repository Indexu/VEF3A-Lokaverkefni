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
				"name" => "",
				"manufacturer" => "",
				"os" => "",
				"cpu" => [
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
					"ssd-size" => ""
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
					"webcam-resolution" => ""
				],
				"io" => [
					"network-adapter" => "",
					"wireless-adapter" => "",
					"hdmi" => "",
					"vga" => "",
					"dvi" => "",
					"usb2" => "",
					"usb3" => "",
					"bluetooth" => "",
					"bluetooth-version" => "",
					"thunderbolt" => "",
					"mini-displayport" => "",
					"headphone-mic" => ""
				],
				"battery" => [
					"type" => "",
					"size" => "",
					"duration" => ""
				],
				"other" => [
					"cd-drive" => "",
					"cd-drive-type" => "",
					"card-reader" => "",
					"keyboard" => "",
					"icelandic-letters" => "",
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
        	$specs["name"] = $name;

        	// cURL it
        	$itemPage = curl($newUrl);
        	// Get area of scraping
        	$itemSpecs = scrape_between($itemPage, "<div id=\"specs\" class=\"tab-pane\">", "<div id=\"customer-overview\"");
        	// Explode area
        	$separate_specs = explode("<tr class=\"product_property\">", $itemPage);

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
		    			$specs["cpu"]["family"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Númer örgjörva':
		    			$specs["cpu"]["id"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Fjöldi kjarna (Core)':
		    			$specs["cpu"]["cores"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Hraði örgjörva (GHz)':
		    			$specs["cpu"]["clockspeed"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Hraði með Turbo Boost':
		    			$specs["cpu"]["turbo"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'CPU Cache':
		    			$specs["cpu"]["cache"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Gerð vinnsluminnis':
		    			$specs["ram"]["type"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Vinnsluminni (GB)':
		    			$specs["ram"]["size"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Hraði vinnsluminnis (MHz)':
		    			$specs["ram"]["clockspeed"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Harður diskur (GB)':
		    			$specs["storage"]["size"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Gerð harðadisks':
		    			$specs["storage"]["type"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Snúningshraði disks':
		    			$specs["storage"]["rpm"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Solid State Drive (SSD)':
		    			$specs["storage"]["ssd"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'SSD (GB)':
		    			$specs["storage"]["ssd-size"] = $elkoSpecs["key"][$i];
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
		    			$specs["screen"]["type"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Skjástærð':
		    			$specs["screen"]["size"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Upplausn':
		    			$specs["screen"]["resolution"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Snertiskjár':
		    			$specs["screen"]["touchscreen"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Vefmyndavél':
		    			$specs["screen"]["webcam"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Vefmyndavél - upplausn':
		    			$specs["screen"]["webcam-resolution"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Gerð netkorts':
		    			$specs["io"]["network-adapter"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Þráðlaust netkort':
		    			$specs["io"]["wireless-adapter"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'HDMI út':
		    			$specs["io"]["hdmi"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'VGA':
		    			$specs["io"]["vga"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'DVI':
		    			$specs["io"]["dvi"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'USB 2.0':
		    			$specs["io"]["usb2"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'USB 3.0':
		    			$specs["io"]["usb3"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Bluetooth':
		    			$specs["io"]["bluetooth"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Bluetooth tækniupplýsingar':
		    			$specs["io"]["bluetooth-version"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Thunderbolt':
		    			$specs["io"]["thunderbolt"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'MiniDisplay Port':
		    			$specs["io"]["mini-displayport"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Tengi fyrir heyrnartól/hljóðnema':
		    			$specs["io"]["headphone-mic"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Rafhlaða':
		    			$specs["battery"]["type"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Rafhlöðuending':
		    			$specs["battery"]["duration"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Tæknilegar upplýsingar um rafhlöðu':
		    			$specs["battery"]["size"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Geisladrif':
		    			$specs["other"]["cd-drive"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'CD/DVD/DVD+R/RW/BD':
		    			$specs["other"]["cd-drive-type"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Minniskortalesari':
		    			$specs["other"]["card-reader"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Lyklaborð':
		    			$specs["other"]["keyboard"] = $elkoSpecs["key"][$i];
		    			break;

		    		case 'Íslenskir stafir á lyklaborði':
		    			$specs["other"]["icelandic-letters"] = $elkoSpecs["key"][$i];
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
		    			$specs["appearance"]["weight"] = $elkoSpecs["key"][$i];
		    			break;
		    		
		    		default:
		    			break;
		    	}
		    }

		    array_push($items["laptops"], $specs);
    	}
    	
    }

    sleep(1);
}

/*echo "<pre>";
print_r($items); // Printing out our array of URLs we've just scraped
echo "</pre>";*/

file_put_contents('../data/elko2.json', json_encode($items));