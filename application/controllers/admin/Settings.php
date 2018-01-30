<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller
{
	/**
	 *
	 * Maps to the following URL
	 * 		http://example.com/settings
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /auth/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_title'] = 'Settings Management';

		$data['email'] = $this->settings_model->get_settings('email');
		$data['google_map_key'] = $this->settings_model->get_settings('google_map_key');
		$data['general_settings'] = $this->settings_model->get_settings('general_settings');
		$data['zipcode_search_radius'] = $this->settings_model->get_settings('zipcode_search_radius');

		$this->load->admin_template('settings/settings', $data);
	}

	/**
	 * get setting method.
	 */
	public function get_settings($settings=null)
	{
		return $this->settings_model->get_settings($settings);
	}

	/**
	 * set setting method.
	 */
	public function save_settings($settings=null)
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$params = $this->input->post();
			$setting_type = $params['setting_type'];
			unset($params['setting_type']);

			switch ($setting_type)
			{
				case 'settype_general':
					$config['max_width'] = 700;
					$config['overwrite'] = true;
					$config['max_height'] = 700;
					$config['max_size'] = 3000000;
					$config['encrypt_name'] = false;
					$config['upload_path'] = './assets/img/';
					$config['allowed_types'] = 'jpg|png|ico|x-icon';
					$this->load->library('upload', $config);
					
					// upload logo
					if(!$_FILES['company_logo']['error'])
					{	
						if (!$this->upload->do_upload('company_logo'))
						{
							$this->session->set_flashdata('flash_error', $this->upload->display_errors());
							redirect(ADMIN_PREFIX . '/settings');
						}

						$data = $this->upload->data();
					// print_r($data);die;
						$params['general_settings']['company_logo'] = 'assets/img/' . $data['file_name'];
					}

					//upload favicon
					if(!$_FILES['company_favicon']['error'])
					{	
						if (!$this->upload->do_upload('company_favicon'))
						{
							$this->session->set_flashdata('flash_error', $this->upload->display_errors());
							redirect(ADMIN_PREFIX . '/settings');
						}

						$data = $this->upload->data();
						$params['general_settings']['company_favicon'] = 'assets/img/' . $data['file_name'];
					}
					break;

				case 'third_party':
				case 'settype_misc':
				case 'settype_email':
					# code...
					break;
				
				default:
					# code...
					break;
			}

			try
			{
				$this->settings_model->save_settings($params);
				$this->session->set_flashdata('flash_message', 'Settings updated successfully.');
			}
			catch (Exception $e)
			{
				$this->session->set_flashdata('flash_error', 'Error occured. Please try again.');
			}

			redirect(ADMIN_PREFIX . '/settings');
		}
	}
}