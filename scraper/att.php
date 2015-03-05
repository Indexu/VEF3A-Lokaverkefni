<?php

require('scraper.php');

// Seperate specs by header and value
function getSpecs($messy_specs){
	$specs = [
		"header" => [],
		"entry" => []
	];

	foreach ($messy_specs as $value) {
		$seperate_entry = explode("-", $value);
		$seperate_entry = array_map('trim',$seperate_entry);

		array_push($specs["header"], array_shift($seperate_entry));

		$entry = "";
		if(count($seperate_entry) > 1){
			for ($i=0; $i < count($seperate_entry); $i++) { 
				$entry .= " " . $seperate_entry[$i];
			}
		}
		else{
			$entry = $seperate_entry[0];
		}

		array_push($specs["entry"], $entry);
	}

	$specs["entry"] = array_map('trim',$specs["entry"]);

	return $specs;
}

function getCpuInfo($cpuEntry){
	$cpu = [
		"family" => [],
		"id" => [],
		"cores" => [],
		"clockspeed" => [],
		"cache" => []
	];

	$cpuEntry = str_replace("Turbo", "", $cpuEntry);
	$cpuEntry = str_replace("GHz", "", $cpuEntry);
	$cpuEntry = str_replace("Core", "", $cpuEntry);
	$cpuEntry = str_replace("core", "", $cpuEntry);
	$cpuEntry = str_replace("með", "", $cpuEntry);
	$cpuEntry = str_replace("flýtiminni", "", $cpuEntry);
	$cpuEntry = explode(" ", $cpuEntry);
	$cpuEntry = array_filter($cpuEntry);
	$cpuEntry = array_values($cpuEntry);
	$cpuEntry = array_map('trim',$cpuEntry);

	echo "<pre>";
	print_r($cpuEntry); // Printing out our array of URLs we've just scraped
	echo "</pre>";

	foreach ($cpuEntry as $key => $value) {
		switch ($key) {
			case 0:
				$cpu["clockspeed"] = $value;
				break;

			case 1:
				$cpu["family"] = $cpuEntry[$key] . " Core " . $cpuEntry[$key + 1];
				break;

			case 3:
				$cpu["id"] = $value;
				break;

			case 4:
				$cpu["cores"] = $value;
				break;

			case 5:
				$cpu["cache"] = $value;
				break;
			
			default:
				break;
		}
	}

	return $cpu;
}

$url = "http://att.is/product/asus-zenbook-ux32ln-fartolva";
$results_page = curl($url);

$results_page = scrape_between($results_page, "<div class=\"info\">", "</div>");

$separate_specs = explode("<br/>", $results_page);
$separate_specs = array_map('trim',$separate_specs);

$specs = getSpecs($separate_specs);

$cpu_specs = getCpuInfo($specs["entry"][1]);

header('Content-Type: text/html; charset=utf-8');

echo "<pre>";
print_r($cpu_specs); // Printing out our array of URLs we've just scraped
echo "</pre>";