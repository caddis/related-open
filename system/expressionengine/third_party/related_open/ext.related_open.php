<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Related Open Extension
 *
 * @package Related Open
 * @author  Caddis
 * @link    http://www.caddis.co
 */

include(PATH_THIRD . 'related_open/config.php');

class Related_open_ext {   
	
	public $name = RELATED_OPEN_NAME;
	public $version = RELATED_OPEN_VER;
	public $description = RELATED_OPEN_DESC;
	public $docs_url = '';
	public $settings_exist	= 'n';
	public $settings = array();
	
	/**
	 * Constructor
	 *
	 * @param  mixed Settings array or empty string if none exist
	 * @return void
	 */
	public function __construct($settings = array())
	{
		$this->settings = $settings;
	}

	/**
	 * Activate Extension
	 * 
	 * @return void
	 */
	public function activate_extension()
	{
		ee()->db->insert('extensions', array(
			'class' => __CLASS__,
			'method' => 'publish_form_entry_data',
			'hook' => 'publish_form_entry_data',
			'settings' => '',
			'priority' => 10,
			'version' => $this->version,
			'enabled' => 'y'
		));
	}

	/**
	 * Update Extension
	 *
	 * @return mixed void on update / false if none
	 */
	public function update_extension($current = '')
	{
		if ($current == $this->version)
		{
			return false;
		}

		return true;
	}

	/**
	 * Disable Extension
	 *
	 * @return void
	 */
	public function disable_extension()
	{
		ee()->db->where('class', __CLASS__);
		ee()->db->delete('extensions');
	}

	/**
	* Bind Links
	*
	* @param array $data
	* @return array $data
	*/
	function publish_form_entry_data($data)
	{
		ee()->cp->load_package_js('base');

		$css = '
		<style type="text/css">
		a.related-open:link {
			position: absolute;
			right: 10px;
			text-decoration: none;
			top: 8px;
			z-index: 9999;
			display: none;
		}
		.multiselect-active a.related-open:link {
			font-weight: normal;
			right: 25px;
			top: 5px;
		}
		.multiselect li:hover a.related-open:link,
		.multiselect-active li:hover a.related-open:link {
			display: inline;
		}
		</style>';

		ee()->cp->add_to_head($css);

		return $data;
	}
}