<?php
		
	include_once ('app/view/view.php');
	
	
	class Controller{
		protected $view = null;
		protected $content = null;
		protected $model = null;
		protected $layout = 'default';
	
		public function __construct($name, $action, $id, $param){
		
			
			$view = new View($name,$action,$this->model);
			
			$this->view = $view->render();
			
			$this->createSite();
		}
		
		public function createSite(){
				
			$content = file_get_contents("app/view/layout/$this->layout/index.php");
			$view = $this->view;
			echo str_replace('<%=content%>',$view,$content);
		}
		
	}