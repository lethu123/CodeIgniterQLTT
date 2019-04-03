<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class User_clas extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_clas_model');
        $this->load->model('Cource_model');
        $this->load->model('Clas_model');
    } 

    /*
     * Listing of user_class
     */
    function index()
    {
        $data['user_class'] = $this->User_clas_model->get_all_user_class();
        $data['course'] = $this->Cource_model->get_all_cource();
        $data['_view'] = 'user_clas/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new user_clas
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('studentID','StudentID','required|max_length[150]');
		$this->form_validation->set_rules('classID','ClassID','required|integer');
		$this->form_validation->set_rules('status','Status','required|max_length[250]');
		$this->form_validation->set_rules('result','Result','required|max_length[250]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'studentID' => $this->input->post('studentID'),
				'classID' => $this->input->post('classID'),
				'status' => $this->input->post('status'),
				'result' => $this->input->post('result'),
            );
            
            $user_clas_id = $this->User_clas_model->add_user_clas($params);
            redirect('user_clas/index');
        }
        else
        {            
            $data['_view'] = 'user_clas/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    function fetch_by_courseID(){
        $courseId=$this->input->post('courseID');
        $sc=$this->Clas_model->get_clas_by_courseID($courseId);//lấy danh sách theo courseId
        print_r($sc);
        if($sc!=""){
            $html="";
            foreach($sc as $key => $obj){
                $html.=" <option value='".($obj['classID'])."'>". ($obj['times'])."</option>";
            }
            print_r($html);//cục html select box
        }
        else{
            echo"<option value=''>không có dữ liệu</option>";
        }
    }

    public function student_by_classID(){
        $classId=$this->input->post('id');
        $value=$this->User_clas_model->get_student_by_classID($classId);//lấy danh sách theo yearSchoolId
        print_r($value);
        for ($i=0; $i < count($value); $i++) {
            $new[$i] = new stdClass;
            $new[$i]->id = $i +1;
            $new[$i]->studentID = $value[$i]['studentID'];
            $new[$i]->status = $value[$i]['status'];
            $new[$i]->result = $value[$i]['result'];
            $new[$i]->action = '
                    <a class="btn btn-warning btn-xs btn-raised" href="' . base_url() . 'user_clas/edit/' . $value[$i]['id'] . '"  data-toggle="tooltip" data-original-title="Sửa"  aria-hidden="true"><i class="material-icons">mode_edit</i></a>
                    <a onclick=\'onDelete("' . $value[$i]['id'] . '","' . $value[$i]['studentID'] . '")\' class="btn btn-danger btn-xs btn-raised" data-toggle="tooltip" title="Xóa"><i class="material-icons">delete</i></a>
                ';
            
        }
        $new = array('data' => $new);        
        // print_r($new);
        // $data = $news;
        $data = json_encode($new,JSON_UNESCAPED_UNICODE);
        print_r($data);
        return;

    }
    /*
     * Editing a user_clas
     */
    function edit($id)
    {   
        // check if the user_clas exists before trying to edit it
        $data['user_clas'] = $this->User_clas_model->get_user_clas($id);
        
        if(isset($data['user_clas']['']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('studentID','StudentID','required|max_length[150]');
			$this->form_validation->set_rules('classID','ClassID','required|integer');
			$this->form_validation->set_rules('status','Status','required|max_length[250]');
			$this->form_validation->set_rules('result','Result','required|max_length[250]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'studentID' => $this->input->post('studentID'),
					'classID' => $this->input->post('classID'),
					'status' => $this->input->post('status'),
					'result' => $this->input->post('result'),
                );

                $this->User_clas_model->update_user_clas($id,$params);            
                redirect('user_clas/index');
            }
            else
            {
                $data['_view'] = 'user_clas/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The user_clas you are trying to edit does not exist.');
    } 

    /*
     * Deleting user_clas
     */
    function remove($id)
    {
        $user_clas = $this->User_clas_model->get_user_clas($id);

        // check if the user_clas exists before trying to delete it
        if(isset($user_clas['']))
        {
            $this->User_clas_model->delete_user_clas($id);
            redirect('user_clas/index');
        }
        else
            show_error('The user_clas you are trying to delete does not exist.');
    }
    
}
