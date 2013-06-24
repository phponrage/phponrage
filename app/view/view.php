<?php 

	class View
	{
		private $view = null;
		
		public function __construct($name,$action,$model)
	    {
			$content="";
			if (file_exists("app/view/$name/$action.php"))
				include("app/view/$name/$action.php");	
			else if($action != null)
				$content="page not exist! 404";
			
			$this->view = $content;
		}
		
		public function render()
		{
			return $this->view;
		}
	}