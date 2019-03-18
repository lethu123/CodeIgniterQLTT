<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Home_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get course by courseID
     */
    function get_course($courseID)
    {
        return $this->db->get_where('courses',array('courseID'=>$courseID))->row_array();
    }
        
    /*
     * Get all courses
     */
    function get_all_courses()
    {
        $this->db->order_by('courseID', 'desc');
        return $this->db->get('courses')->result_array();
    }
        
    /*
     * function to add new course
     */
    function add_course($params)
    {
        $this->db->insert('courses',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update course
     */
    function update_course($courseID,$params)
    {
        $this->db->where('courseID',$courseID);
        return $this->db->update('courses',$params);
    }
    
    /*
     * function to delete course
     */
    function delete_course($courseID)
    {
        return $this->db->delete('courses',array('courseID'=>$courseID));
    }
}
