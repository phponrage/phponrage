<?php
	class Model{
		
		protected $hostSQL = null;
		protected $userSQL = null;
		protected $passSQL = null;
		protected $nameSQL = null;
		protected $connectSQL = null;
		protected $db_selected = null;
		protected $fields = null;
		protected $table = null;
		protected $id = null;
		
		public function __construct($table, $fields, $action, $id, $param){
		
			include_once ('app/dbconfig.php');
			
			$this->hostSQL = $hostSQL;
			$this->userSQL = $userSQL;
			$this->passSQL = $passSQL;
			$this->nameSQL = $nameSQL;
			$this->table = $table;
			$this->fields = $fields;
			
			if($action == 'show')
				$this->show($id);
			if($action == 'new' && !empty($_POST))
				$this->add();
			if($action == 'edit' ){
				
				if(!empty($_POST))
					$this->edit($id);
				$this->show($id);
			}
			if($action == 'del'){
				$this->del($id);
				header("Location: /index.php");//to do
			}
		}
		
		protected function connect(){
		
			$this->connectSQL = mysql_connect($this->hostSQL, $this->userSQL, $this->passSQL); 
			$this->db_selected = mysql_select_db($this->nameSQL, $this->connectSQL);
		}
		
		public function add(){
			$this->connect();
			$table = $this->table;
			$keys='';
			$values='';
			$keysArray = array_keys($this->fields);
			$i = 0;
			foreach($keysArray as $value){
				if ($i>0){
					$keys.=",".$value;
					$values.=", '".$this->fields[$value]."'";
				}
				else{
					$keys.=$value;
					$values.="'".$this->fields[$value]."'";
					$i++;
				}
			}

			mysql_query("INSERT INTO $table ($keys) VALUES ($values)",$this->connectSQL);
			mysql_close($this->connectSQL);
		}
		
		public function edit($id){
			$this->connect();
			$table = $this->table;
			$query = '';
			$keysArray = array_keys($this->fields);
			$i = 0;
			foreach($keysArray as $value){
				if($this->fields[$value] != null){
					if ($i>0){
						$query.= ",".$value."='".$this->fields[$value]."'";
					}
					else{
						$query.= $value."='".$this->fields[$value]."'";
						$i++;
					}
				}
			}
			if($i>0)
				mysql_query("UPDATE $table SET $query WHERE ID='$id'",$this->connectSQL);
			mysql_close($this->connectSQL);
		}
		
		public function del($id){
			$this->connect();
			$table = $this->table;
			mysql_query("DELETE FROM $table WHERE ID=$id",$this->connectSQL);
			mysql_close($this->connectSQL);
		}
		
		public function show($id){
			$this->connect();
			$table = $this->table;
			$query = mysql_query("SELECT * FROM $table WHERE ID=$id",$this->connectSQL)
			or die("Błąd w zapytaniu!"); 
 
			$result = mysql_fetch_array($query);
			
			$keysArray = array_keys($this->fields);
			$i=1;
			$this->id = $result[0];
			foreach($keysArray as $value){
				$this->fields[$value]=$result[$i];
				$i++;
			}
			mysql_close($this->connectSQL);
			return null;
		}		
		
		public function get($string){		
			if($string == "id")
				return $this->id;
			else
				return $this->fields[$string];
		}
			
	}