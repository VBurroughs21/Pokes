<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Controller {
	public function signin()
	{
		$this->load->view('signin');
	}
	public function get_user()
	{ //login
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$user = $this->session_m->get_user($email);

		if ($user && $user['password'] == $password) 
		{
			$user_info = array(
				'current_id' => $user['id'],
				'logged_on' => TRUE
			);

			$this->session->set_userdata($user_info);
			redirect(base_url("/users/pokes/$user[id]"));

		} 
		else 
		{
			$this->session->set_flashdata('login_error', "Invalid email or password");
			redirect(base_url(" "));
		}

		// $this->load->library("form_validation");
		// $this->form_validation->set_rules
		// ("email", "Email Address", "trim|required|valid_email");
		// $this->form_validation->set_rules
		// ("password", "Password", "trim|required");

		// if ($this->form_validation->run() === FALSE) {
		// 	$this->view_data['errors'] = validation_errors();
		// 	$this->session->set_flashdata('login_error', $this->view_data['errors']);
		// 	redirect(base_url(" "));
		// } else {
		// 	redirect(base_url());
		// }
		
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(" "));
	}


}