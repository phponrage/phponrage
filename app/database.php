<?php

	class DataBase{
		
	   private $hostSQL = null;
	   private $uzytkownikMySQL = null;
	   private $hasloUzytkownika = null;
	   private $nazwaBazy = null;
	   private $polaczeneSQL = null;
		
		public function __construct(){
		
			include_once ('app/config.php');
			
			$this->hostSQL = $hostSQL;
			$this->uzytkownikSQL = $uzytkownikSQL;
			$this->hasloUzytkownika = $hasloUzytkownika;
			$this->nazwaBazy = $nazwaBazy;
			
		}
		
		public function connect(){
		
			$this->polaczenieSQL = mysql_connect($this->hostSQL, $this->uzytkownikSQL, $this->hasloUzytkownika); //je�eli si� po��czy to da nam warto�� prawda, a je�eli nie to fa�sz
		
		}
		
	}