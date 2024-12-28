<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Group extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_group');
	}

	/**
	 * @api {get} /group/all Get all groups.
	 * @apiVersion 0.1.0
	 * @apiName AllGroup
	 * @apiGroup Group
	 * @apiHeader {String} X-Api-Key Groups unique access-key.
	 * @apiHeader {String} X-Token Groups unique token.
	 * @apiPermission Group Cant be Accessed permission name : api_group_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Groups.
	 * @apiParam {String} [Field="All Field"] Optional field of Groups.
	 * @apiParam {String} [Start=0] Optional start index of Groups.
	 * @apiParam {String} [Limit=10] Optional limit data of Groups.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of group.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataGroup Group data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_group_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$groups = $this->model_group->get($filter, $field, $limit, $start);

		$data['group'] = $groups;

		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data group',
			'data'	 	=> $data
		], API::HTTP_OK);
	}
	
	/**
	 * @api {get} /group/detail Detail Group.
	 * @apiVersion 0.1.0
	 * @apiName DetailGroup
	 * @apiGroup Group
	 * @apiHeader {String} X-Api-Key Groups unique access-key.
	 * @apiHeader {String} X-Token Groups unique token.
	 * @apiPermission Group Cant be Accessed permission name : api_group_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Groups.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of group.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError GroupNotFound Group data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_group_detail');

		$this->requiredInput(['id']);

		$id = $this->get('id');

		$data['group'] = $this->model_group->find($id);
		
		if (count($data['group'])) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail group',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Group not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
	/**
	 * @api {post} /group/add Add Group.
	 * @apiVersion 0.1.0
	 * @apiName AddGroup
	 * @apiGroup Group
	 * @apiHeader {String} X-Api-Key Groups unique access-key.
	 * @apiHeader {String} X-Token Groups unique token.
	 * @apiPermission Group Cant be Accessed permission name : api_group_add
	 *
	 * @apiParam {String} Name Mandatory name of Groups.
	 * @apiParam {String} [Definition] Optional definition of Groups.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function add_post()
	{
		$this->is_allowed('api_group_add');

		$this->form_validation->set_rules('name', 'Nama', 'trim|required|is_unique[aauth_groups.name]|alpha_numeric_spaces');
		$this->form_validation->set_rules('definition', 'Definition', 'trim');

		if ($this->form_validation->run()) {

			$save_data = [
				'name' 			=> $this->post('name'),
				'definition' 	=> $this->post('definition'),
			];

			$save_group = $this->model_group->store($save_data);

			if ($save_group) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully stored into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> $this->aauth->print_errors()
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	/**
	 * @api {post} /group/update Update Group.
	 * @apiVersion 0.1.0
	 * @apiName UpdateGroup
	 * @apiGroup Group
	 * @apiHeader {String} X-Api-Key Groups unique access-key.
	 * @apiHeader {String} X-Token Groups unique token.
	 * @apiPermission Group Cant be Accessed permission name : api_group_update
	 *
	 * @apiParam {String} Name Mandatory Name of Groups.
	 * @apiParam {String} [Definition] Optional definition of Groups.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function update_post()
	{
		$this->is_allowed('api_group_update');

		$this->form_validation->set_rules('name', 'Nama', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('definition', 'Definition', 'trim');
		$this->form_validation->set_rules('id', 'Id', 'trim|required');

		if ($this->form_validation->run()) {

			$save_data = [
				'name' 			=> $this->post('name'),
				'definition' 	=> $this->post('definition'),
			];

			$save_group = $this->model_group->change($this->post('id'), $save_data);

			if ($save_group) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully updated into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> $this->aauth->print_errors()
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
	/**
	 * @api {post} /group/delete Delete Group. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteGroup
	 * @apiGroup Group
	 * @apiHeader {String} X-Api-Key Groups unique access-key.
	 * @apiHeader {String} X-Token Groups unique token.
	 * @apiPermission Group Cant be Accessed permission name : api_group_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Groups .
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function delete_post()
	{
		$this->is_allowed('api_group_delete');

		if (!$this->model_group->find($this->post('id'))) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Group not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
		$delete = $this->model_group->remove($this->post('id'));
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Group deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Group not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
}

/* End of file Group.php */
/* Location: ./application/controllers/api/Group.php */