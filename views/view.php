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
		$counter = 0;

		echo "<div class='row' data-equalizer>";
		foreach ($this->model->items["laptops"] as $laptop) {

			if($counter == 4){
				$counter = 0;
				echo "</div>";
				echo "<div class='row' data-equalizer>";
			}

			echo "<div class='large-3 columns catalogueEntry panel' data-equalizer-watch>";
			foreach ($laptop as $header => $value) {
				switch ($header) {
					case 'name':
						echo "<h4 class='cataItemName'>" . $value . "</h4>";
						echo "<ul class='cataItemSpec'>";
						break;

					case 'os':
						echo "<li>OS: " . $value . "</li>";
						break;

					case 'cpu':
						echo "<li>CPU: " . $value["type"] . " " . $value["family"] . " @ " . $value["clockspeed"] . "GHz</li>";
						break;

					case 'ram':
						echo "<li>RAM: " . $value["size"] . "GB " . $value["type"] . " @ " . $value["clockspeed"] . "MHz</li>";
						break;

					case 'storage':
						echo "<li>Storage: " . $value["size"] . $value["ssd-size"] . "GB " . $value["type"] . "</li>";
						break;

					case 'screen':
						echo "<li>Screen: " . $value["size"] . "\" @ " . $value["resolution"] . "</li>";
						echo "</ul>";
						break;
					
					default:
						# code...
						break;
				}
			}
			//if($counter != 4){
				echo "</div>";
			//}

			$counter++;
			
		}
		echo "</div>";
		echo "<pre>";
		print_r($this->model->items);
	}
}