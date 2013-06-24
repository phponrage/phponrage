<?php
	class Model{
		
		protected $hostSQL = null;
		protected $userSQL = null;
		protected $passSQL = null;
		protected $nameSQL = null;
		protected $connectSQL = null;
		protected $fields = null;
		protected $table = null;
		
		public function __construct($table,$fields){
		
			include_once ('app/dbconfig.php');
			
			$this->hostSQL = $hostSQL;
			$this->userSQL = $uzytkownikSQL;
			$this->passSQL = $hasloUzytkownika;
			$this->nameSQL = $nazwaBazy;
			$this->table = $table;
			$this->fields = $fields;
			
		}
		
		private function connect(){
		
			$this->connectSQL = mysql_connect($this->hostSQL, $this->uzytkownikSQL, $this->hasloUzytkownika); 
		}
		
		public function add($name){
			return "$name";
		}
		
		public function edit($name, $id){
			return null;
		}
		
		public function del($name, $id){
			return null;
		}
		
		public function show($name, $id){
			return null;
		}
		
		public function slist($name, $id, $param){
			return null;
		}
			
	}