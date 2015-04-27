<?php

class Controller {
		public $model;
		
		public function __construct(Model $model){
			$this->model = $model;
		}
		
		public function sortprice(){
			$price = array();
			foreach ($this->model->items["laptops"] as $key => $row) {
				$price[$key] = $row['price'];
			}

			array_multisort($price, SORT_DESC, $this->model->items["laptops"]);
		}

		public function filter(){
			foreach ($_GET as $filterName => $filterValue) {
				if($filterName != "filter"){
					$filterName = explode("_", $filterName);

					if(count($filterName) == 2){
						// Slider filter check
						if(($filterName[0] == "cpu" && $filterName[1] == "clockspeed") ||($filterName[0] == "ram" && $filterName[1] == "size") ||($filterName[0] == "storage" && $filterName[1] == "size")){
							foreach ($this->model->items["laptops"] as $laptopNumber => $laptopSpecs) {
							
								if(strtolower($laptopSpecs[$filterName[0]][$filterName[1]]) < $filterValue){
									unset($this->model->items["laptops"][$laptopNumber]);
								}
							}
						}
						else if($filterName[0] == "screen" && $filterName[1] == "size"){
							foreach ($this->model->items["laptops"] as $laptopNumber => $laptopSpecs) {
								switch ($filterValue) {
									case "20":
										if($laptopSpecs[$filterName[0]][$filterName[1]] < 13){
											unset($this->model->items["laptops"][$laptopNumber]);
										}
										break;

									case "30":
										if($laptopSpecs[$filterName[0]][$filterName[1]] < 15){
											unset($this->model->items["laptops"][$laptopNumber]);
										}
										break;

									case "40":
										if($laptopSpecs[$filterName[0]][$filterName[1]] < 17){
											unset($this->model->items["laptops"][$laptopNumber]);
										}
										break;
									
									default:
										break;
								}
							}
						}
						else if($filterName[0] == "screen" && $filterName[1] == "resolution"){
							foreach ($this->model->items["laptops"] as $laptopNumber => $laptopSpecs) {
								if($filterValue >= "20"){
									if(in_array($laptopSpecs[$filterName[0]][$filterName[1]], $this->model->resolution_blacklist[0])){
										unset($this->model->items["laptops"][$laptopNumber]);
										continue;
									}
								}

								if($filterValue >= "30"){
									if(in_array($laptopSpecs[$filterName[0]][$filterName[1]], $this->model->resolution_blacklist[1])){
										unset($this->model->items["laptops"][$laptopNumber]);
										continue;
									}
								}

								if($filterValue >= "40"){
									if(in_array($laptopSpecs[$filterName[0]][$filterName[1]], $this->model->resolution_blacklist[2])){
										unset($this->model->items["laptops"][$laptopNumber]);
										continue;
									}
								}

								if($filterValue >= "50"){
									if(in_array($laptopSpecs[$filterName[0]][$filterName[1]], $this->model->resolution_blacklist[3])){
										unset($this->model->items["laptops"][$laptopNumber]);
										continue;
									}
								}

								if($filterValue == "60"){
									if(in_array($laptopSpecs[$filterName[0]][$filterName[1]], $this->model->resolution_blacklist[4])){
										unset($this->model->items["laptops"][$laptopNumber]);
										continue;
									}
								}

							}
						}
						// True/false check
						else{
							foreach ($this->model->items["laptops"] as $laptopNumber => $laptopSpecs) {
								
								if(is_array($filterValue)){
									if(!in_array(strtolower($laptopSpecs[$filterName[0]][$filterName[1]]), $filterValue)){
										unset($this->model->items["laptops"][$laptopNumber]);
									}
								}
								else{
									if(strtolower($laptopSpecs[$filterName[0]][$filterName[1]]) != $filterValue){
										unset($this->model->items["laptops"][$laptopNumber]);
									}
								}
							}
						}
					}
					else{
						if($filterName[0] == "maxPrice"){
							foreach ($this->model->items["laptops"] as $laptopNumber => $laptopSpecs) {
							
								if(strtolower(str_replace(".", "", $laptopSpecs["price"])) > $filterValue){
									unset($this->model->items["laptops"][$laptopNumber]);
								}
							}
						}
						else if($filterName[0] == "minPrice"){
							foreach ($this->model->items["laptops"] as $laptopNumber => $laptopSpecs) {
							
								if(strtolower(str_replace(".", "", $laptopSpecs["price"])) < $filterValue){
									unset($this->model->items["laptops"][$laptopNumber]);
								}
							}
						}
						else{
							foreach ($this->model->items["laptops"] as $laptopNumber => $laptopSpecs) {
							
								if(strtolower($laptopSpecs[$filterName[0]]) != $filterValue){
									unset($this->model->items["laptops"][$laptopNumber]);
								}
							}
						}
						
					}
				}
			}
		}
}