<?php

class User extends CI_Model {

	function create($user_info)
	{ //for registration
	   		$query = "INSERT INTO users(name, alias, email, password, created_at, updated_at) 
	   					VALUES(?,?,?,?,NOW(),NOW())";
	   		$values = array($user_info['name'], $user_info['alias'], $user_info['email'], $user_info['password']);

	   		return $this->db->query($query, $values);
	}

	function show($id)
	{ 
	   	return $this->db->query("SELECT id, email, name, alias
   								FROM users 
								WHERE id = ?", array($id))->row();
	}
	function all_users($id)
	{  
	   	return $this->db->query("SELECT users.id, users.name, users.alias, users.email, pokes.poked_id, SUM(pokes.num_pokes) AS num_pokes  
	   							FROM users
	   							LEFT JOIN pokes
								ON users.id = pokes.poked_id
	   							WHERE users.id !=?
	   							GROUP BY pokes.poked_id
	   							ORDER BY num_pokes DESC", 
	   							array($this->session->userdata('current_id')))->result_array();

	}
	function show_pokes($id)
	{
		return $this->db->query("SELECT users.alias, pokes.num_pokes, pokes.poked_id, pokes.poker_id
	   							FROM users
	   							LEFT JOIN pokes
								ON users.id = pokes.poker_id
	   							WHERE pokes.poked_id = ?
	   							ORDER BY pokes.num_pokes DESC", array($id))->result_array();
	}
	function count_pokes($id)
	{
		return $this->db->query("SELECT *
	   							FROM pokes
	   							WHERE pokes.poked_id = $id")->num_rows();

	}
	// function number_pokes($id, $current_id)
	// {
	// 	return $this->db->query("SELECT *
	// 							FROM pokes
	// 							WHERE pokes.poker_id=? && pokes.poked_id=?", 
	// 							array($id,  $this->session->userdata('current_id')))->num_rows();
	
	// }
	function add_poke($id)
	{
		
		$query = $this->db->query("SELECT * FROM pokes
									WHERE pokes.poked_id = ? && pokes.poker_id=?", 
									array($id, $this->session->userdata('current_id')));
		$count = $query->num_rows();

		if ($count === 0) {
			return $this->db->query("INSERT INTO pokes(poker_id, poked_id, num_pokes)
		 							VALUES(?,?, 1)", array($this->session->userdata('current_id'), $id));
		} else {
			return $this->db->query("UPDATE pokes 
		 						SET num_pokes=num_pokes+1
		 						WHERE pokes.poked_id = ? && pokes.poker_id=?", 
		 						array($id, $this->session->userdata('current_id')));
		}

		
		
	}
	
}





















