<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	//defined('BONUS_DEFINITION_PATH') or define('BONUS_DEFINITION_PATH', __DIR__ . DS . 'definitions' . DS);
	
	/**
	* AB
	*
	* Executes assigned code based on user's AB group
	*
	* @package	AB-test
	* @author	John Gills
	*/	
	class Ab {

		/**
		 * @access private
		 * @var    CI Instance
		 */
		private $CI = null;

		/**
		 * Stores feature data
		 * @access private
		 * @var array
		 */
		private $featureCache = array();

		/**
		* Stores User AB test group
		* @access private
		* @var int
		*/
		private $abGroup = null;
		
		/**
		 * 
		 * @access public
		 * @var array params
		 *
		 */
		public function __construct($params=array()) {
			$this->CI =& get_instance();
			if (isset($params['abGroupId'])) {
			    $params['abGroupId'] = empty($params['abGroupId']) ? 0 : $params['abGroupId'];
                	    $abGroupId = $params['abGroupId'];
			} else {
			    $abGroupId = NULL;
			}
			if (!empty($abGroupId)) {
				$this->setAbGroup($abGroupId);			
				$this->loadFeatureCacheIfEmpty();
			}
		}
		
		/**
		 * 
		 * @param string $tag
		 * @return bool
		 */
		public function isFeatureA($tag) {
		    return !$this->isFeatureB($tag);
		}
		
		/**
		*
		* @param string $tag
		* @return bool
		*/		
		public function isFeatureB($tag) {
		    $test = false;
		    foreach($this->featureCache as $feature) {
		        
		        if($feature['feature_tag'] === $tag) {
		            $test = ($feature['feature'] === 'B') ? true : false;
		            break;
		        }
		    }

		    return $test;
		}

		/**
		*
		* Executes 1 of 2 provided methods based on AB group
		* Note that argsA is the second parameter and can be left blank
		* @param string $tag
		* @param mixed $argsA
		* @param array $argsB
		* @return mixed 
		* 
		*/
		public function execute($tag, array $argsB, $argsA=null) {	
		    
		    $args = $argsA;
		    if ($this->isFeatureB($tag)) {
		        $args = $argsB;
		    }
		    if (!is_array($args)) {
		        if (is_callable($args)) {
		            // args is actually a function
		            $method = $args;
		        } else {
    		        // if args is not array or func, probably null, then they are in A group and an argsA was not passed so do nothing
    		        return false;
		        }
		    } else {
    		    if (empty($args['method'])) {
    		        log_message('error', 'No method provided.');
    		        return false;
    		    }
    		    if (!empty($args['obj'])) {
    		        $method = array($args['obj'], $args['method']);
    		    } else {
    		        $method = $args['method'];
    		    }
    		    $params = (!empty($args['params'])) ? $args['params'] : array();
		    }   
		    

		    
		    try {
    		    return call_user_func_array($method,$params);
		    } catch (Exception $e) {
		        log_message('error', 'Error: ' . $e->getMessage());
		        return false;
		    }
		    
		}
		
		private function loadFeatureCacheIfEmpty() {

		    $this->CI->load->model('ab/feature_model');
		    try {
    		    if (count($this->featureCache) <= 0)
    		        $this->featureCache = $this->CI->feature_model->loadFeatures($this->abGroup);
		    } catch (Exception $e) {
		        log_message('error', 'Error: ' . $e->getMessage());		        
		    }
		    
		}
		
		public function setAbGroup($abGroupId) {
		    if (!isset($abGroupId)) {
		        $this->abGroup = 0;
		    } else {
		        $this->abGroup = $abGroupId;
		    }
		    
		}
		
		public function getFeatures() {
		    $this->loadFeatureCacheIfEmpty();
		    return $this->featureCache;
		}
		
		
	}
	
