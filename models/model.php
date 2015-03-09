<?php

class Model {
	public $items = array();
	public $tite;
	
	public function __construct(){
		
		$this->title = "Ókeypis";
		
		try{
			$json = file_get_contents('data/elko.json');
			$this->items = json_decode($json, true);
		} catch(Exception $e){
			 die('Caught exception: '.  $e->getMessage(). "\n");
		}
		
		
	}
	
}