<?php

/**
 * DB connection
 * query - get, delete, insert
 *
 * @author Stephen
 */
class DB {

   private static $_instance = null;
   private $_pdo,
           $_query,
           $_error = false,
           $_results,
           $_count = 0;

   // create an instance of the DB PDO connection
   private function __construct() {
      try {
         $this->_pdo = new PDO('mysql:host='. Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));        
      } catch (PDOException $e) {
         die($e->getMessage());
      }
   }
	
   // DB check if an instance of the DB has been created if not create DB connection
   public static function getInstance() {
      if (!isset(self::$_instance)) {
         self::$_instance = new DB();
      }
      return self::$_instance;
   }

   /* call query and assign to variable and check 
   		query string and has anything been defined and then pdo bind values */
   public function query($sql, $params = array()) {
   	$this->_error = false;
   	/* Check DB server has successfully prepares the statement, returns a PDOStatement object. 
   	If not prepare returns FALSE. Add PDOException */
      if ($this->_query = $this->_pdo->prepare($sql)) {
         $x = 1;
         if(count($params)) {
            foreach($params as $param) {
               $this->_query->bindValue($x, $param);
               $x++;
            }
         }
         	/* check teh stored query and execute is sucessful PDO 
         	   fetchAll return array of values as objects
               and PDO statement rowCount return number of rows */
	        if($this->_query->execute()) {
	            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
	            $this->_count = $this->_query->rowCount();

	        } else {
	        	$this->_error = true;
	        }                
        }
        // return current object
        return $this;
	}

	// used to preform a specific action
	// easier to define queries
	public function action($action, $table, $where = array()) {
		if(count($where) === 3) {

			// allow only these operators
			
			$operators = array('=', '>', '<', '>=', '<=', '*');
			
			$field 		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];
		
			if(in_array($operator, $operators)) {
				// select * from table
				// {action}{$operator} FROM {table}
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				
				// if not error return 
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
		}
		return false;
	}	

	// get everything from where 
	public function get($table, $where) {
		return $this->action('SELECT *', $table, $where);	
	}
	
	public function delete($table, $where) {
		return $this->action('DELETE', $table, $where);
	}
	
	// insert into DB
	public function insert($table, $fields = array()) {
		if(count($fields)) {
			$keys = array_keys($fields);
			$values = null;
			$x = 1;
			
			foreach($fields as $field) {
				$values .= "?";
			if($x < count($fields)) {
				$values .= ', ';
				}
				$x++;
			}
			
			$sql = "INSERT INTO register(`" . implode('`, `', $keys) . "`) VALUES ({$values}) ";
			
			if($this->query($sql, $fields)->error()) {
				return true;
			}
		}
		return false;
	}

	public function results() {
		return $this->_results;
	}

	public function error() {
		return $this->_error;
	}

	public function count() {
		return $this->_count;
	}
}