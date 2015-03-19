<?php

class View {
	public $model;
	private $controller;
	private $dwoo;
	
	public function __construct(Controller $controller, Model $model) {
		$this->controller = $controller;
		$this->model = $model;

		// Register Dwoo namespace and register autoloader
		$autoloader = new Dwoo\Autoloader();
		$autoloader->add('Dwoo', 'libs/Dwoo');
		$autoloader->register(true);

		$this->dwoo = new Dwoo\Core();
	}
	
	public function title(){
		echo '<h1>' . $this->model->title . '</h1>';
	}

	
	public function laptopCatalogue(){

		$tpl = new \Dwoo\Template\File('templates/laptopCatalogue.tpl');
		$data = new \Dwoo\Data();
		$data->assign('laptops', $this->model->items["laptops"]);

		$this->dwoo->output($tpl, $data);

		echo "<pre>";
		print_r($this->model->items);

		/*$counter = 0;

		echo "<a href='?action=sortprice'><button>Sort:Price</button></a>";

		echo "<div class='row' data-equalizer>";
		foreach ($this->model->items["laptops"] as $laptop) {

			if($counter == 4){
				$counter = 0;
				echo "</div>";
				echo "<div class='row' data-equalizer>";
			}

			echo "<a href='" . $laptop["url"] . "'>";
				echo "<div class='large-3 columns catalogueEntry panel' data-equalizer-watch>";

					echo "<h4 class='cataItemName'>" . $laptop["name"] . "</h4>";
					echo "<ul class='cataItemSpec'>";
						echo "<li>OS: " . $laptop["os"] . "</li>";
						echo "<li>CPU: " . $laptop["cpu"]["type"] . " " . $laptop["cpu"]["family"] . " @ " . $laptop["cpu"]["clockspeed"] . "GHz</li>";
						echo "<li>RAM: " . $laptop["ram"]["size"] . "GB " . $laptop["ram"]["type"] . " @ " . $laptop["ram"]["clockspeed"] . "MHz</li>";
						echo "<li>Storage: " . $laptop["storage"]["size"] . $laptop["storage"]["ssd-size"] . "GB " . $laptop["storage"]["type"] . "</li>";
						echo "<li>Screen: " . $laptop["screen"]["size"] . "\" @ " . $laptop["screen"]["resolution"] . "</li>";
						echo "<li>Price: " . $laptop["price"] . "</li>";

			//if($counter != 4){
					echo "</ul>";
				echo "</div>";
			echo "</a>";
			//}

			$counter++;
			
		}
		echo "</div>";
		echo "<pre>";
		print_r($this->model->items);*/
	}
}