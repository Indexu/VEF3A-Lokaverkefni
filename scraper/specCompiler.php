<?php

$elkoJson = file_get_contents('../data/elko.json');
$elkoArray = json_decode($elkoJson, true);

$specs = [
	"price" => [
		"min" => "",
		"max" => ""
	],
	"manufacturer" => [],
	"os" => [],
	"cpu" => [
		"type" => [],
		"family" => [],
		"id" => [],
		"cores" => [],
		"clockspeed" => [],
		"cache" => []
	],
	"ram" => [
		"type" => [],
		"size" => [],
		"clockspeed" => []
	],
	"storage" => [
		"size" => [],
		"type" => [],
		"rpm" => []
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
		"webcam_resolution" => []
	],
	"io" => [
		"network_adapter" => [],
		"wireless_adapter" => [],
		"hdmi" => [],
		"vga" => [],
		"dvi" => [],
		"usb2" => [],
		"usb3" => [],
		"bluetooth" => [],
		"thunderbolt" => [],
		"mini_displayport" => [],
		"headphone_mic" => []
	],
	"battery" => [
		"type" => [],
		"size" => [],
		"duration" => []
	],
	"other" => [
		"cd_drive-type" => [],
		"card_reader" => []
	],
	"appearance" => [
		"color" => [],
		"weight" => []
	]
];

$prices = [];

foreach ($elkoArray["laptops"] as $laptopNumber) {
	foreach ($laptopNumber as $spec => $value) {
		if(is_array($value)){
			foreach ($value as $subspec => $subvalue) {
				if(array_key_exists($subspec, $specs[$spec])){
					array_push($specs[$spec][$subspec], $subvalue);
				}
			}
		}
		else{
			if($spec == "manufacturer" || $spec == "os"){
				array_push($specs[$spec], $value);
			}
			else if($spec == "price"){
				array_push($prices, $value);
			}
		}
	}
}

$specs["price"]["min"] = min($prices);
$specs["price"]["max"] = max($prices);

// Manufacturers
$result = array_count_values($specs["manufacturer"]);
arsort($result);
$specs["manufacturer"] = $result;

// OS
$result = array_count_values($specs["os"]);
arsort($result);
$specs["os"] = $result;

/*  CPU  */
// Cpu type
$result = array_count_values($specs["cpu"]["type"]);
arsort($result);
$specs["cpu"]["type"] = $result;

// Cpu family
$result = array_count_values($specs["cpu"]["family"]);
arsort($result);
$specs["cpu"]["family"] = $result;

// Cpu id
$result = array_count_values($specs["cpu"]["id"]);
arsort($result);
$specs["cpu"]["id"] = $result;

// Cpu cores
$result = array_count_values($specs["cpu"]["cores"]);
arsort($result);
$specs["cpu"]["cores"] = $result;

// Cpu clockspeed
$result = array_count_values($specs["cpu"]["clockspeed"]);
arsort($result);
$specs["cpu"]["clockspeed"] = $result;

// Cpu cache
$result = array_count_values($specs["cpu"]["cache"]);
arsort($result);
$specs["cpu"]["cache"] = $result;

/*  RAM  */
// Ram type
$result = array_count_values($specs["ram"]["type"]);
arsort($result);
$specs["ram"]["type"] = $result;

// Ram size
$result = array_count_values($specs["ram"]["size"]);
arsort($result);
$specs["ram"]["size"] = $result;

// Ram clockspeed
$result = array_count_values($specs["ram"]["clockspeed"]);
arsort($result);
$specs["ram"]["clockspeed"] = $result;

/*  Storage  */
// storage type
$result = array_count_values($specs["storage"]["type"]);
arsort($result);
$specs["storage"]["type"] = $result;

// storage size
$result = array_count_values($specs["storage"]["size"]);
arsort($result);
$specs["storage"]["size"] = $result;

// storage rpm
$result = array_count_values($specs["storage"]["rpm"]);
arsort($result);
$specs["storage"]["rpm"] = $result;

/*  Sound graphic  */
// Soundcard
$result = array_count_values($specs["soundgraphic"]["soundcard"]);
arsort($result);
$specs["soundgraphic"]["soundcard"] = $result;

// GPU
$result = array_count_values($specs["soundgraphic"]["gpu"]);
arsort($result);
$specs["soundgraphic"]["gpu"] = $result;

// vram
$result = array_count_values($specs["soundgraphic"]["vram"]);
arsort($result);
$specs["soundgraphic"]["vram"] = $result;

/*  Screen  */
// Screen type
$result = array_count_values($specs["screen"]["type"]);
arsort($result);
$specs["screen"]["type"] = $result;

// Screen size
$result = array_count_values($specs["screen"]["size"]);
arsort($result);
$specs["screen"]["size"] = $result;

// Screen resolution
$result = array_count_values($specs["screen"]["resolution"]);
arsort($result);
$specs["screen"]["resolution"] = $result;

// Screen touchscreen
$result = array_count_values($specs["screen"]["touchscreen"]);
arsort($result);
$specs["screen"]["touchscreen"] = $result;

// Screen webcam
$result = array_count_values($specs["screen"]["webcam"]);
arsort($result);
$specs["screen"]["webcam"] = $result;

// Screen webcam resolution
$result = array_count_values($specs["screen"]["webcam_resolution"]);
arsort($result);
$specs["screen"]["webcam_resolution"] = $result;

/*  IO  */
// network adapter
$result = array_count_values($specs["io"]["network_adapter"]);
arsort($result);
$specs["io"]["network_adapter"] = $result;

// wireless adapter
$result = array_count_values($specs["io"]["wireless_adapter"]);
arsort($result);
$specs["io"]["wireless_adapter"] = $result;

// hdmi
$result = array_count_values($specs["io"]["hdmi"]);
arsort($result);
$specs["io"]["hdmi"] = $result;

// vga
$result = array_count_values($specs["io"]["vga"]);
arsort($result);
$specs["io"]["vga"] = $result;

// dvi
$result = array_count_values($specs["io"]["dvi"]);
arsort($result);
$specs["io"]["dvi"] = $result;

// usb2
$result = array_count_values($specs["io"]["usb2"]);
arsort($result);
$specs["io"]["usb2"] = $result;

// usb3
$result = array_count_values($specs["io"]["usb3"]);
arsort($result);
$specs["io"]["usb3"] = $result;

// bluetooth
$result = array_count_values($specs["io"]["bluetooth"]);
arsort($result);
$specs["io"]["bluetooth"] = $result;

// thunderbolt
$result = array_count_values($specs["io"]["thunderbolt"]);
arsort($result);
$specs["io"]["thunderbolt"] = $result;

// mini_displayport
$result = array_count_values($specs["io"]["mini_displayport"]);
arsort($result);
$specs["io"]["mini_displayport"] = $result;

// headphone_mic
$result = array_count_values($specs["io"]["headphone_mic"]);
arsort($result);
$specs["io"]["headphone_mic"] = $result;

/*  Battery  */
// Battery type
$result = array_count_values($specs["battery"]["type"]);
arsort($result);
$specs["battery"]["type"] = $result;

// Battery size
$result = array_count_values($specs["battery"]["size"]);
arsort($result);
$specs["battery"]["size"] = $result;

// Battery duration
$result = array_count_values($specs["battery"]["duration"]);
arsort($result);
$specs["battery"]["duration"] = $result;

/*  Other  */
// cd drive
$result = array_count_values($specs["other"]["cd_drive-type"]);
arsort($result);
$specs["other"]["cd_drive-type"] = $result;

// Battery size
$result = array_count_values($specs["other"]["card_reader"]);
arsort($result);
$specs["other"]["card_reader"] = $result;

/*  Appearance  */
// cd drive
$result = array_count_values($specs["appearance"]["color"]);
arsort($result);
$specs["appearance"]["color"] = $result;

// Battery size
$result = array_count_values($specs["appearance"]["weight"]);
arsort($result);
$specs["appearance"]["weight"] = $result;

print "<pre>";
print_r($specs);

file_put_contents('../data/spec_sheet.json', json_encode($specs));