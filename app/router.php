<?php
	$migrate = true;
	$params = explode('/',$_SERVER['REQUEST_URI']);
	if (isset($params[1]) && $params[1]!="")
		$name = $params[1];
	else
		$name = "static";
		
	if (isset($params[2]) && $params[2]!="")	
		$action = $params[2];
	else
		$action = "home";
		
	if (isset($params[3]))
		$id = $params[3];
	else
		$id = null;
			
	if (isset($params[4]))
		$param = $params[4];
	else
		$param = null;
	if (isset($params[1]) && $params[1]=="migrate" && $migrate == true)
		include_once ('app/migrate.php');
	else if (isset($params[1]) && $params[1]!="" && file_exists('app/controller/'.$name.'/'.$name.'.php'))
		include_once ('app/controller/'.$name.'/'.$name.'.php');
	else{
		include_once ('app/controller/controller.php');
		$controller = new controller($name, $action, $id, $param);
	}
	
	