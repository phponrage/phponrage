<?php
	include_once ('app/dbconfig.php');
	$connect = mysql_connect($hostSQL, $uzytkownikSQL, $hasloUzytkownika); 
	$podlaczDoBazy = mysql_select_db('rails', $connect);
	if($podlaczDoBazy){
		if ($handle = opendir('app/migrations/')) {
			while (false !== ($file = readdir($handle)) )
			{
				$params = explode('.',$file);
				if ($params[1] == 'php'){		
					include_once ('app/migrations/'.$file);
				}
			}
			closedir($handle);
			mysql_close();
		}
	}
	else
		echo"Nie udało się podłączyć do bazy testowej.<br />";