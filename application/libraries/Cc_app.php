<?php

/**
 * CC app Class
 *
 * @package			Cicool  
 * @category		component
 */
#[AllowDynamicProperties]
class Cc_App
{
	
	/**
	 * App
	 *
	 * @var			array
	 * @access		public
	 */
	public $app = [];

	/**
	 * Header frontend register
	 *
	 * @var			array
	 * @access		public
	 */
	public $headers = [];

	/**
	 * Registered event
	 *
	 * @var			array
	 * @access		public
	 */
	public $registeredEvent = [];

	/**
	 * Route prefix
	 *
	 * @var			string
	 * @access		public
	 */
	public $routePrefix;


	public function __construct($config = [])
	{
		$this->ci =& get_instance();
		$this->ci->load->database();

		$this->initialize($config);
	}

	/**
	 * Initialize preferences
	 *
	 * @access	public
	 * @param	array $config
	 * @return	void
	 */
	public function initialize($config = [])
	{
		foreach ($config as $key => $val)
		{
			$this->{$key} = $val;
		}
	}

	/**
	 * Get option
	 *
	 * @access		public
	 * @param		string $option_name
	 * @param		string $option_value
	 * @return		boolean
	 */
	public function getOption($option_name, $default = null)
	{
		if ($option = $this->optionExists($option_name)) {
			if (!empty($option)) {
				return $option;
			} else {
				return $default;
			}
		}

		return $default;
	}

	/**
	 * Add option
	 *
	 * @access		public
	 * @param		string $option_name
	 * @param		string $option_value
	 * @return		boolean
	 */
	public function addOption($option_name =  null, $option_value = null)
	{
		if ($this->optionExists($option_name, $option_value) === false) {
			return $this->ci->db->insert('cc_options', [ 
				'option_name' => $option_name,
				'option_value' => $option_value 
				]);
		}

		return false;
	}

	/**
	 * Set option
	 *
	 * @access		public
	 * @param		string $option_name
	 * @param		string $option_value
	 * @return		boolean
	 */
	public function setOption($option_name =  null, $option_value = null)
	{
		if ($this->optionExists($option_name, $option_value) === false) {
			$this->addOption($option_name, $option_value);
		} else {
			return $this->ci->db
						->where(['option_name' => $option_name])
						->update('cc_options', [ 'option_value' => $option_value]);
		}
	}

	/**
	 * Delete option
	 *
	 * @access		public
	 * @param		string $option_name
	 * @return		boolean
	 */
	public function deleteOption($option_name =  null)
	{
		return $this->ci->db
					->where(['option_name' => $option_name])
					->delete('cc_options');
	}

	/**
	 * Check option exists 
	 *
	 * @access		public
	 * @param		string $option_name
	 * @return		mixed string | boolean
	 */
	public function optionExists($option_name =  null)
	{
		$result = $this->ci->db->get_where('cc_options', [ 'option_name' => $option_name]);

		if ($row = $result->row()) {
			return $row->option_value;
		}

		return false;
	}

	/**
	 * Get header frontend 
	 *
	 * @access		public
	 * @return		String
	 */
	public function eventListen($eventName = null, $params = [])
	{
		$body = null;
		foreach ($this->getEvent($eventName) as $function) {
			if (is_object($function)) {
				$body .= $function($params);
			} elseif(function_exists($function)) {
				$body .= call_user_func_array($function, $params);
			}
		}

		return $body;
	}

	/**
	 * Cc on event 
	 *
	 * @access		public
	 * @param 		String $eventName
	 * @param 		Mixed String | Object $action
	 * @return		String
	 */
	public function onEvent($eventName = null, $action = null)
	{
		$this->registeredEvent[$eventName][] = $action;

		return $this;
	}

	/**
	 * Get event 
	 *
	 * @access		public
	 * @param 		String $eventName
	 * @return		Mixed String | Array
	 */
	public function getEvent($eventName = null)
	{
		if (isset($this->registeredEvent[$eventName])) {
			return $this->registeredEvent[$eventName];
		} else {
			return [];
		}
	}

	/**
	 * Get header 
	 *
	 * @access		public
	 * @param 		String $eventName
	 * @return		String
	 */
	public function getHeader()
	{
		return $this->eventListen('front_head');
	}

	/**
	 * Get footer 
	 *
	 * @access		public
	 * @return		String
	 */
	public function getFooter()
	{
		return $this->eventListen('front_footer');
	}

	/**
	 * Get navigation 
	 *
	 * @access		public
	 * @return		String
	 */
	public function getNavigation()
	{
		return $this->eventListen('front_navigation');
	}


	/**
	 * Cc on route 
	 *
	 * @access		public
	 * @param 		String $route
	 * @param 		Mixed String | Array $method
	 * @param 		Mixed String | Object $action
	 * @return		String
	 */
	public function onRoute($action, $route = null, $method = 'get')
	{
		if ($this->thisRoute($this->routePrefix .$route, $method, $action)) {
			$this->routePrefix = $route;
			if (is_object($action)) {
				$action();
			} elseif(function_exists($action)) {
				call_user_func_array($action);
			}
			exit;
		}
	}

	/**
	 * Cc this route 
	 *
	 * @access		public
	 * @param 		String $route
	 * @param 		Mixed String | Array $method
	 * @return		Boolean
	 */
	public function thisRoute($route = null, $method = 'get')
	{
		$current_uri = $this->ci->uri->uri_string;
		$route = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $route);

		if (is_string($method)) {
			$method = [$method];
		}
		if (preg_match('#^'.$route.'$#', $current_uri, $matches)) {
			if (in_array($this->ci->input->method(), $method)) {
				return true;
			}
		}

		return false;
	}
}
