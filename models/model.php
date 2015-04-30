<?php

class Model {
	public $items = array();
	public $specs = array();
	public $resolution_blacklist = array();
	public $tite;
	public $root;
	
	public function __construct(){
		
		$this->title = "Ókeypis";
		$this->root = $_SERVER["DOCUMENT_ROOT"] . "/vef3a-lokaverkefni/";
		
		try{
			$elkojson = file_get_contents($this->root . 'data/elko.json');
			$this->items = json_decode($elkojson, true);

			$spec_sheet_json = file_get_contents($this->root . 'data/spec_sheet.json');
			$this->specs = json_decode($spec_sheet_json, true);
		} catch(Exception $e){
			 die('Caught exception: '.  $e->getMessage(). "\n");
		}
		
		$this->resolution_blacklist[0][0] = "1366x768";
		$this->resolution_blacklist[0][1] = "1440x900";
		$this->resolution_blacklist[0][2] = "1600x900";
		$this->resolution_blacklist[0][3] = "1280x800";
		$this->resolution_blacklist[1][0] = "1920x1080";
		$this->resolution_blacklist[2][0] = "2560x1600";
		$this->resolution_blacklist[2][1] = "2880x1800";
		$this->resolution_blacklist[3][0] = "3200x1800";
		$this->resolution_blacklist[4][0] = "3840x2160";

	}
	
}