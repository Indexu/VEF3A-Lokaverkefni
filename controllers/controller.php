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
}