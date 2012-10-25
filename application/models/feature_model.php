<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * AB_Feature
     *
     * This model is used for AB testing
     *
     * @package	AB-test
     * @author	John Gills
     */
    class Feature_model extends MY_Model
    {
    	private $feature_table			= 'feature';
    	private $feature_x_group_table	= 'feature_x_abgroup';
    	private $memKey = '';
    	private $CI;
    
    	public function __construct()
    	{
    		parent::__construct($this->feature_table);
    		$this->CI =& get_instance();
    	}
    	
    	public function loadFeatures($abGroup) {
    	    
    	    if (empty($abGroup) && $abGroup !== 0) {
    	        return array();
    	    }
    	    $this->db->select(array('feature_id','feature_tag',"IF(fxa_feature IS NULL, 'A', 'B') feature"));
    	    $this->db->from($this->feature_table);
    	    $this->db->join($this->feature_x_group_table, 'feature_id = fxa_feature AND fxa_abgroup = ' . $abGroup, 'LEFT');
    	    $result = $this->db->get()->result_array();
    	    return $result;
    	}
    	
    	public function getGroupsByFeature($featureTag) {
    	    $result = array();
    	    $this->db->select('fxa_abgroup');
    	    $this->db->from($this->feature_table);
    	    $this->db->join($this->feature_x_group_table, 'feature_id = fxa_feature', 'LEFT');
    	    $this->db->where('feature_tag',$featureTag);
    	    $data = $this->db->get()->result_array();
    	    foreach ($data as $datum) {
    	        $result[] = $datum['fxu_abgroup'];
    	    }
    	    return $result;
    	    
    	}
    	
    	
    }