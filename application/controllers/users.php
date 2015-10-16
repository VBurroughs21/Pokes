<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}
	public function pokes($id)
	{
		$this->session->set_userdata('user', $this->user->show($id));
		$this->session->set_userdata('all_users', $this->user->all_users($id));
		$this->session->set_userdata('show_pokes', $this->user->show_pokes($id));
		$this->session->set_userdata('count_pokes', $this->user->count_pokes($id));
		$this->load->view('pokes', $this->session->userdata('user'));
	} 
	public function create()
	{  //registration
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$alias = $this->input->post('alias');
		$password = md5($this->input->post('password'));
		$con_password = md5($this->input->post('con_password'));
		$dob = $this->input->post('dob');

		

		$user_info = array(
			'email' => $email,
			'name' => $name,
			'alias' => $alias,
			'password' => $password,
			'con_password' => $con_password,
			'dob' => $dob
		);

		$this->load->library("form_validation");
		$this->form_validation->set_rules(
			"email", "Email Address", "trim|required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules(
			"name", "Name", "trim|required");
		$this->form_validation->set_rules(
			"alias", "Alias", "trim|required");
		$this->form_validation->set_rules(
			"password", "Password", "trim|required");
		$this->form_validation->set_rules(
			"con_password", "Confirm Password", "trim|required|matches[password]");
		$this->form_validation->set_rules(
			"dob", "Date of Birth", "required");
		
		if ($this->form_validation->run() === FALSE) 
		{
			$this->view_data['errors'] = validation_errors();
			$this->session->set_flashdata('reg_error', $this->view_data['errors']);
				redirect(base_url(" "));

			
		} 
		else 
		{
			$this->user->create($user_info);
			$user = $this->session_m->get_user($email); 
			$user_info = array(
				'current_id' => $user['id'],
				'logged_on' => TRUE
			);

			$this->session->set_userdata($user_info);
			redirect(base_url("/users/pokes/$user[id]"));
		}
	}
	public function add_poke($id)
	{	
		$current_id = $this->session->userdata('current_id');
		$this->user->add_poke($id);
		redirect(base_url("/users/pokes/$current_id"));
	}

	
}

//end of main controller









