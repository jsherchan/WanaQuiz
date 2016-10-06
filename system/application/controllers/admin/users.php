<?php

/**

 * Users Controller

 *

 * @author Paul Shen

 * @copyright 2006 Paul Shen

 * 

 * This file is part of CodeIgniter Goals

 * 

 * CodeIgniter Goals is free software; you can redistribute it and/or modify

 * it under the terms of the GNU General Public License as published by

 * the Free Software Foundation; either version 3 of the License, or

 * (at your option) any later version.

 */

class Users extends Controller {



	function Users()

	{

		parent::Controller();

		$this->load->scaffolding('tbladmin_login');

		//$this->output->enable_profiler(TRUE);

	}

	

	/**

	 * Login

	 * 

	 * <p>$username and $password fields are required.

	 * $redirect_to is appended to end of uri. Redirects to after registration</p>

	 * 

	 * @uses User_model

	 * @uses session

	 * @uses validation

	 * @uses form

	 * @uses url

	 */

	function login()

	{

		$this->load->library('session');

		$this->load->library('validation');

		$this->load->model('User_model');

		$this->load->helper('form');

		$rules['username']	= "required";

		$rules['password']	= "required";		

		$this->validation->set_rules($rules);

		$fields['username']	= 'Username';

		$fields['password']	= 'Password';

		$this->validation->set_fields($fields);
		$buffer =strlen('/'.ADMIN_PATH.'/users/login');

		$data['redirect_to'] = substr($this->uri->uri_string(), $buffer); 

		if ($this->validation->run() == FALSE)

		{
			$this->load->view('admin/users_login', $data);
		}
		else
		{

			$user_id = $this->User_model->login($this->validation->username, $this->validation->password);

			if($user_id != 0)
			{
		
				$this->session->set_userdata(array('wannaquiz_admin_user_id' => $user_id));

				$data['user'] =$this->User_model->getDetails($user_id);

				$this->session->set_userdata(array('admin_user_name' =>$data['user']->username));
				redirect(ADMIN_PATH.'/home/', 'refresh');
				
			}
			else
			{
				$data['message'] = "Incorrect username and password combination";
				$this->load->view('admin/users_login', $data);
			}

		}

	}

	

	/**

	 * Logout

	 * 

	 * <p>Destroys the user's session.

	 * Redirects to user index</p>

	 * 

	 * @uses User_model

	 * @uses session

	 * @uses url

	 */
	
	function logout()

	{

		$this->load->model('User_model');

		$this->load->library('session');

		$this->load->helper('url');
	
		$this->session->destroy();

		redirect('/'.ADMIN_PATH.'/admin', 'refresh');

	}
	

}

?>