<?php
require_once('../Models/Model.php');
require_once('../Views/View.php');

class Controller {

	public $model;
	public $view;

	public function __construct() {
		$this->model = new Model();
		$this->view = new View(); 
	}	

}

?>