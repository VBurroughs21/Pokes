<?php

class Session_m extends CI_Model {
	
	function get_user($email)
	{   //for login
	   		return $this->db->query("SELECT id, email, password, name, alias 
	   			FROM users 
				WHERE email = ?", array($email))->row_array();
	}
	




}