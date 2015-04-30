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
		$autoloader->add('Dwoo', $this->model->root . 'libs/Dwoo');
		$autoloader->register(true);

		$this->dwoo = new Dwoo\Core();
	}
	
	public function navbar(){
		$tpl = new \Dwoo\Template\File($this->model->root . 'templates/navbar.tpl');
		$data = new \Dwoo\Data();
		$data->assign('title', $this->model->title);

		$this->dwoo->output($tpl, $data);
	}

	public function footer(){
		$tpl = new \Dwoo\Template\File($this->model->root . 'templates/footer.tpl');

		$this->dwoo->output($tpl);
	}

	public function aboutPage(){
		$tpl = new \Dwoo\Template\File($this->model->root . 'templates/about.tpl');

		$this->dwoo->output($tpl);
	}

	public function contactPage(){
		$tpl = new \Dwoo\Template\File($this->model->root . 'templates/contact.tpl');

		$this->dwoo->output($tpl);
	}

	
	public function laptopCatalogue(){
		$tpl = new \Dwoo\Template\File($this->model->root . 'templates/laptopCatalogue.tpl');
		$data = new \Dwoo\Data();
		$data->assign('laptops', $this->model->items["laptops"]);
		$data->assign('specs', $this->model->specs);
		$data->assign('filters', $_GET);

		$this->dwoo->output($tpl, $data);

		/*echo "<pre>";
		print_r($this->model->items);*/
	}
}