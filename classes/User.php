<?php
Class User {
	/* Create a user */
	private $_db,
		$_data,
		$_sessionName;
	
	public function __construct($user = null) {
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
		
		if(!$user) {
			if(Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);
				echo $user;
			}
		}
	}

	public function create($fields = array()) {
		if($this->_db->insert('registered', $fields)) {
			throw new Exception('Hmmm Problems'); 
		}
	}
	
	public function find($user = null) {
		if($user) {
			$field = (is_numeric($user)) ? 'id' : 'name';
			$data = $this->_db->get('registered', array($field, '=', $user));
			
			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}
	
	public function login($name = null) {
		
		$user = $this->find($name);	
		
		}	
		
	
	private function data() {
		return $this->_data;
	}
}