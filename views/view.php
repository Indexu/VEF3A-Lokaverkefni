<?php

class View {
	public $model;
	private $controller;
	
	public function __construct(Controller $controller, Model $model) {
		$this->controller = $controller;
		$this->model = $model;
	}
	
	public function title(){
		echo '<h1>' . $this->model->title . '</h1>';
	}
	
	public function laptopCatalogue(){
		echo "<div class='row'>";
		foreach ($this->model->items["laptops"] as $laptop) {

			foreach ($laptop as $header => $value) {
				if($header == "name"){
					echo "<div class='large-3 columns catalogueEntry'>";
					echo "<p>" . $value . "</p>";
					echo "</div>";
				}
			}
			
		}
		echo "</div>";
		/*echo "<pre>";
		print_r($this->model->items);*/
	}
}