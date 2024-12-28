<?php


/**
* Librarry for crud generator
*
* @author Muhamad Ridwan
* @package Cicool
* @since 2016
*/
#[AllowDynamicProperties]
class Cc_page_element
{

	/**
	 * List Filter html
	 *
	 * @var			Array
	 * @access		public
	 */
	protected $listFilterHtmlFunction = [];

	/**
	 * List Un Filter html function
	 *
	 * @var			Array
	 * @access		public
	 */
	protected $listUnFilterHtmlFunction = [];
	
	/**
	 * Html content
	 *
	 * @var			String
	 * @access		public
	 */
	protected $htmlContent = null;

	public function __construct($config = [])
	{
		$this->ci =& get_instance();
		$this->initialize($config);
	}

	/**
	 * Initialize preferences
	 *
	 * @access	public
	 * @param	array
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
	 * Get page element
	 *
	 * @access	public
	 * @param	string $group
	 * @return	array
	 */
	function getPageElement($group = false) {
		$this->ci->load->helper('directory');

		$el_path = FCPATH . 'cc-content/page-element/';
		$dir = directory_map($el_path);
		$list_element = [];

		foreach ($dir as $dirname => $childs) {
			if (is_file($el_path . $dirname . '/el.json')) {
				$el_info = file_get_contents($el_path . $dirname . '/el.json');
				$el_info_array = json_decode($el_info);
				if (!is_object($el_info_array)) {
					die('Invalid package format');
				}

				$el_info_array->path = $el_path . $dirname;

				if (isset($el_info_array->package) AND is_array($el_info_array->package)) {
					foreach ($el_info_array->package as $package) {
						$package->dirname = $dirname;
						
						/*required field*/
						foreach (['source', 'name', 'description', 'preview'] as $field) {
							if (!isset($package->$field)) {
								die('Please define field '.$field.' in package');
							}
						}

						if (!isset($package->group)) {
							$package->group = 'template';
						}
						if (!isset($package->preview)) {
							$package->preview = BASE_ASSET . 'img/element-default-preview.jpg';
						} else {
							$package->preview = BASE_URL . '/cc-content/page-element/' . $dirname . '/' . $package->preview;
						}

						$list_element[strtolower($package->group)][] = $package;
					}
				}
			}
		}

		if ($group !== false) {
			if (isset($list_element[$group])) {
				return $list_element[$group];
			}
		} else {
			return $list_element;
		}

		return false;
	}

	/**
	 * Display page element
	 *
	 * @access	public
	 * @return	html
	 */
	function displayPageElement() {

	    $result = $this->getPageElement();
	    $ret = null;

	    foreach ($result as $group_name => $data) {
		    $ret .= '<li><a href="#">'.ucwords($group_name).'</a>';
	    		$ret .= '<ul>';
	    		foreach ($data as $child) {
	    			$ret .= '<li class="block-item" data-src="'.$child->dirname .'/'.$child->source.'" data-block-name="'.$child->dirname.'">
				                <div class="nav-content-wrapper noselect">
				                  <i class="fa fa-gear"></i>
				                  <div class="tool-nav delete">
				                    <i class="fa fa-trash"></i> <span class="info-nav">Delete</span>
				                  </div>
				                  <div class="tool-nav source">
				                    <i class="fa fa-code"></i> <span class="info-nav">Source</span>
				                  </div>
				                  <div class="tool-nav copy">
				                    <i class="fa fa-copy"></i> <span class="info-nav">Copy</span>
				                  </div>
				                  <div class="tool-nav handle">
				                    <i class="fa fa-arrows"></i> <span class="info-nav">Move</span>
				                  </div>
				                </div>
				              <img title="'.$child->name.'" alt="'.$child->name.'" src="'.$child->preview.'" data-src="aadas/asdasd.html" class="preview-only">
				              <div class="block-content editable"><div class="edit"></div></div>
				            </li>';
	    		}
	    		$ret .= '</ul>';

		    $ret .= '</li>';
	    }
	    return $ret;
	}

	/**
	 * Parse html
	 *
	 * @access		public
	 * @param		String $html
	 * @return		string
	 */
	public function parseHtml($html = null)
	{
		foreach ($this->getListParseHtml() as $function) {
			if (is_object($function)) {
				$html = $function($html);
			} elseif(function_exists($function)) {
				$html = call_user_func_array($function, [$html]);
			}
		}

		return $html;
	}

	/**
	 * Add parsing html
	 *
	 * @access		public
	 * @param		String $function_name
	 * @return		string
	 */
	public function registerParseHtml($function_name)
	{
		$this->listFilterHtmlFunction[] = $function_name;
	}

	/**
	 * get parsing html
	 *
	 * @access		public
	 * @param		Closure $function_name
	 * @return		string
	 */
	public function  getListParseHtml()
	{
		return $this->listFilterHtmlFunction;
	}

	/**
	 * Unparse html
	 *
	 * @access		public
	 * @param		String $html
	 * @return		string
	 */
	public function unParseHtml($html = null)
	{
		foreach ($this->getListUnParseHtml() as $function) {
			if (is_object($function)) {
				$html = $function($html);
			} elseif(function_exists($function)) {
				$html = call_user_func_array($function, [$html]);
			}
		}

		return $html;
	}

	/**
	 * Add un parsing html
	 *
	 * @access		public
	 * @param		String $function_name
	 * @return		string
	 */
	public function registerUnParseHtml($function_name)
	{
		$this->listUnFilterHtmlFunction[] = $function_name;
	}

	/**
	 * get un parsing html
	 *
	 * @access		public
	 * @param		Closure $function_name
	 * @return		string
	 */
	public function  getListUnParseHtml()
	{
		return $this->listUnFilterHtmlFunction;
	}

}