<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Detail_uuc extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_uuc_model');
    } 

    /*
     * Listing of detail_uuc
     */
    function index()
    {
        $data['detail_uuc'] = $this->Detail_uuc_model->get_all_detail_uuc();
        
        $data['_view'] = 'detail_uuc/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new detail_uuc
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('account','Account','required|max_length[150]');
		$this->form_validation->set_rules('userClassID','UserClassID','required|integer');
		$this->form_validation->set_rules('status','Status','required|max_length[250]');
		$this->form_validation->set_rules('certificate','Certificate','required|max_length[250]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'account' => $this->input->post('account'),
				'userClassID' => $this->input->post('userClassID'),
				'status' => $this->input->post('status'),
				'certificate' => $this->input->post('certificate'),
            );
            
            $detail_uuc_id = $this->Detail_uuc_model->add_detail_uuc($params);
            redirect('detail_uuc/index');
        }
        else
        {            
            $data['_view'] = 'detail_uuc/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a detail_uuc
     */
    function edit($)
    {   
        // check if the detail_uuc exists before trying to edit it
        $data['detail_uuc'] = $this->Detail_uuc_model->get_detail_uuc($);
        
        if(isset($data['detail_uuc']['']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('account','Account','required|max_length[150]');
			$this->form_validation->set_rules('userClassID','UserClassID','required|integer');
			$this->form_validation->set_rules('status','Status','required|max_length[250]');
			$this->form_validation->set_rules('certificate','Certificate','required|max_length[250]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'account' => $this->input->post('account'),
					'userClassID' => $this->input->post('userClassID'),
					'status' => $this->input->post('status'),
					'certificate' => $this->input->post('certificate'),
                );

                $this->Detail_uuc_model->update_detail_uuc($,$params);            
                redirect('detail_uuc/index');
            }
            else
            {
                $data['_view'] = 'detail_uuc/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The detail_uuc you are trying to edit does not exist.');
    } 

    /*
     * Deleting detail_uuc
     */
    function remove($)
    {
        $detail_uuc = $this->Detail_uuc_model->get_detail_uuc($);

        // check if the detail_uuc exists before trying to delete it
        if(isset($detail_uuc['']))
        {
            $this->Detail_uuc_model->delete_detail_uuc($);
            redirect('detail_uuc/index');
        }
        else
            show_error('The detail_uuc you are trying to delete does not exist.');
    }
    
}
