<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class User_clas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get user_clas by userClassID
     */
    function get_user_clas($userClassID)
    {
        return $this->db->get_where('user_class',array('userClassID'=>$userClassID))->row_array();
    }
        
    /*
     * Get all user_class
     */
    function get_all_user_class()
    {
        $this->db->order_by('userClassID', 'desc');
        return $this->db->get('user_class')->result_array();
    }
        
    /*
     * function to add new user_clas
     */
    function add_user_clas($params)
    {
        $this->db->insert('user_class',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update user_clas
     */
    function update_user_clas($userClassID,$params)
    {
        $this->db->where('userClassID',$userClassID);
        return $this->db->update('user_class',$params);
    }
    
    /*
     * function to delete user_clas
     */
    function delete_user_clas($userClassID)
    {
        return $this->db->delete('user_class',array('userClassID'=>$userClassID));
    }
}
