<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stores extends CI_Controller
{
	/**
	 *
	 * Maps to the following URL
	 * 		http://example.com/stores
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /auth/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model(ADMIN_PREFIX . '/stores_model');
	}

	public function index()
	{
		$data['page_title'] = 'Stores Management';
		$data['all_records'] = $this->stores_model->all_records_list();

		$this->load->admin_template('stores/list', $data);
	}
	
	public function store_edit()
	{
		$this->load->model(ADMIN_PREFIX . '/stores_category_model');
		$this->load->model(ADMIN_PREFIX . '/stores_attachment_model');
		
		$data['all_states'] = get_states();
		$data['all_countries'] = get_countries();
		$data['all_store_categories'] = $this->stores_category_model->all_records();
		if ($this->uri->segment(3))
		{
			$data['store_details'] = $this->stores_model->store_edit($this->uri->segment(3));
			if (sizeof($data['store_details']) == 0)
			{
				$this->session->set_flashdata('flash_error', 'Store does not exist');
				redirect(ADMIN_PREFIX .'/stores');
			}

			$data['store_details']['store_menus'] = $this->stores_attachment_model->store_attachments($this->uri->segment(3), STORE_ATCH_MENU);
			$data['store_details']['store_images'] = $this->stores_attachment_model->store_attachments($this->uri->segment(3), STORE_ATCH_IMAGE);
			$data['store_details']['store_videos'] = $this->stores_attachment_model->store_attachments($this->uri->segment(3), STORE_ATCH_VIDEO);

			$this->load->admin_template('stores/edit', $data);
		}
		else
		{
			$this->load->admin_template('stores/add', $data);
		}
	}
	
	public function store_save()
	{
		$params = $this->input->post();
		$insert_arr['attachments']['menu'] = $_FILES['store_menu'];
		$insert_arr['attachments']['image'] = $_FILES['store_image'];
		$insert_arr['attachments']['video'] = array_filter($params['store_video']);
		
		unset($params['store_video']);

		$insert_arr['address'] = $params['address'];
		unset($params['address']);

		$store_schedule = $params['store_schedule'];
		unset($params['store_schedule']);

		$insert_arr['schedule'] = array();
		foreach ($store_schedule as $keySS => $valueSS)
		{
			$insert_arr['schedule'][strtolower(date("l", strtotime($keySS)))] = NULL;
			if (sizeof(array_filter($valueSS)) > 0)
			{
				$insert_arr['schedule'][$keySS] = implode(" - ", $valueSS);
			}
		}

		//Get Lat Long of choosen Zipcode
		$get_lat_long = get_zipcode_details($params['store_zipcode_id']);
		if (sizeof($get_lat_long) > 0) 
		{
			$params['store_latitude'] = $get_lat_long['latitude'];
			$params['store_longitude'] = $get_lat_long['longitude'];
		}
		else
		{
			if ($this->uri->segment(3)) 
			{
				$this->session->set_flashdata('flash_error', 'Error occured while saving Store. Zipcode Incorrect.');
				redirect(ADMIN_PREFIX . '/edit-store/' . $this->uri->segment(3));
			}
			else
			{
				$this->session->set_flashdata('flash_error', 'Error occured while saving Store. Zipcode Incorrect.');
				redirect(ADMIN_PREFIX . '/add-store');
			}
		}

		$insert_arr['basic'] = $params;
		$insert_arr['basic']['featured_image'] = $_FILES['store_featured_image'];
		if ($this->uri->segment(3))
		{
			/***UPDATE EXISTING***/
			$insert_id = $this->stores_model->store_save($insert_arr, $this->uri->segment(3));
		}
		else
		{
			/***SAVE NEW***/
			$insert_id = $this->stores_model->store_save($insert_arr);
		}

		if ($insert_id)
		{
			$this->session->set_flashdata('flash_message', 'Store saved successfully.');
			redirect(ADMIN_PREFIX . '/edit-store/' . $insert_id);
		}
		else
		{
			$this->session->set_flashdata('flash_error', 'Error occured while saving Store. Please try again.');
			redirect(ADMIN_PREFIX . '/add-store');
		}
	}

	public function store_delete()
	{
		try
		{
			$this->stores_model->store_delete($this->input->post('id'), array("deleted_at" => date("Y-m-d H:i:s"), "updated_at" => date('Y-m-d H:i:s')));

			$this->load->model(ADMIN_PREFIX . '/stores_attachment_model');
			$this->stores_attachment_model->store_attachment_update($this->input->post('id'), array("deleted_at" => date("Y-m-d H:i:s"), "updated_at" => date('Y-m-d H:i:s')));

			$this->session->set_flashdata('flash_message', 'Store deleted successfully.');
			echo json_encode(array("status" => 1));die;
		}
		catch (Exception $e)
		{
			echo json_encode(array("status" => 0, "message" => "Error while deleting store. Please try again."));die;
		}
	}

	public function store_attachment_delete()
	{
		try
		{
			$this->load->model(ADMIN_PREFIX . '/stores_attachment_model');

			$this->stores_attachment_model->attachment_update($this->input->post('id'), array("deleted_at" => date("Y-m-d H:i:s"), "updated_at" => date('Y-m-d H:i:s')));
			echo json_encode(array("status" => 1));die;
		}
		catch (Exception $e)
		{
			echo json_encode(array("status" => 0, "message" => "Error while deleting. Please try again."));die;
		}
	}
}