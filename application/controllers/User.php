<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class User extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    } 

    /*
     * Listing of users
     */
    function index()
    {
        $data['users'] = $this->User_model->get_all_users();
        
        $data['_view'] = 'user/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new user
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('name','Name','required|max_length[250]');
		$this->form_validation->set_rules('pass','Pass','required|max_length[250]');
		$this->form_validation->set_rules('email','Email','max_length[250]|valid_email');
		$this->form_validation->set_rules('phone','Phone','integer');
		$this->form_validation->set_rules('gender','Gender','required|max_length[3]');
		$this->form_validation->set_rules('address','Address','max_length[250]');
		$this->form_validation->set_rules('userTypeID','UserTypeID','required|max_length[20]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'name' => $this->input->post('name'),
				'pass' => $this->input->post('pass'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'birthday' => $this->input->post('birthday'),
				'userTypeID' => $this->input->post('userTypeID'),
            );
            
            $user_id = $this->User_model->add_user($params);
            redirect('user/index');
        }
        else
        {            
            $data['_view'] = 'user/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a user
     */
    function edit($account)
    {   
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($account);
        
        if(isset($data['user']['account']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','required|max_length[250]');
			$this->form_validation->set_rules('pass','Pass','required|max_length[250]');
			$this->form_validation->set_rules('email','Email','max_length[250]|valid_email');
			$this->form_validation->set_rules('phone','Phone','integer');
			$this->form_validation->set_rules('gender','Gender','required|max_length[3]');
			$this->form_validation->set_rules('address','Address','max_length[250]');
			$this->form_validation->set_rules('userTypeID','UserTypeID','required|max_length[20]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'name' => $this->input->post('name'),
					'pass' => $this->input->post('pass'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'gender' => $this->input->post('gender'),
					'address' => $this->input->post('address'),
					'birthday' => $this->input->post('birthday'),
					'userTypeID' => $this->input->post('userTypeID'),
                );

                $this->User_model->update_user($account,$params);            
                redirect('user/index');
            }
            else
            {
                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The user you are trying to edit does not exist.');
    } 

    /*
     * Deleting user
     */
    function remove($account)
    {
        $user = $this->User_model->get_user($account);

        // check if the user exists before trying to delete it
        if(isset($user['account']))
        {
            $this->User_model->delete_user($account);
            redirect('user/index');
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }
    
}