<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Blog Category Controller
*| --------------------------------------------------------------------------
*| Blog Category site
*|
*/
class Blog_category extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_blog_category');
	}

	/**
	* show all Blog Categorys
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('blog_category_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['blog_categorys'] = $this->model_blog_category->get($filter, $field, $this->limit_page, $offset);
		$this->data['blog_category_counts'] = $this->model_blog_category->count_all($filter, $field);

		$config = [
			'base_url'     => 'blog_category/index/',
			'total_rows'   => $this->model_blog_category->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Blog Category List');
		$this->render('backend/app-menu/blog_category/blog_category_list', $this->data);
	}
	
	/**
	* Add new blog_categorys
	*
	*/
	public function add()
	{
		$this->is_allowed('blog_category_add');

		$this->template->title('Blog Category New');
		$this->render('backend/app-menu/blog_category/blog_category_add', $this->data);
	}

	/**
	* Add New Blog Categorys
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('blog_category_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|max_length[200]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'category_name' => $this->input->post('category_name'),
				'category_desc' => $this->input->post('category_desc'),
			];

			
			$save_blog_category = $this->model_blog_category->store($save_data);

			if ($save_blog_category) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_blog_category;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('blog_category/edit/' . $save_blog_category, 'Edit blog category').' atau  '.anchor('blog_category', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('blog_category/edit/' . $save_blog_category, 'Edit blog category'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('blog_category');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('blog_category');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Blog Categorys
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('blog_category_update');

		$this->data['blog_category'] = $this->model_blog_category->find($id);

		$this->template->title('Blog Category Update');
		$this->render('backend/app-menu/blog_category/blog_category_update', $this->data);
	}

	/**
	* Update Blog Categorys
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('blog_category_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|max_length[200]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'category_name' => $this->input->post('category_name'),
				'category_desc' => $this->input->post('category_desc'),
			];

			
			$save_blog_category = $this->model_blog_category->change($id, $save_data);

			if ($save_blog_category) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('blog_category', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('blog_category');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('blog_category');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Blog Categorys
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('blog_category_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('blog_category');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data blog category berhasil dihapus.', 'success');
		} else {
            set_message('Gagal menghapus data blog category.', 'error');
		}

		redirect('blog_category');
	}

		/**
	* View view Blog Categorys
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('blog_category_view');

		$this->data['blog_category'] = $this->model_blog_category->find($id);

		$this->template->title('Blog Category Detail');
		$this->render('backend/app-menu/blog_category/blog_category_view', $this->data);
	}
	
	/**
	* delete Blog Categorys
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$blog_category = $this->model_blog_category->find($id);

		
		
		return $this->model_blog_category->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('blog_category_export');

		$this->model_blog_category->export('blog_category', 'blog_category');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('blog_category_export');

		$this->model_blog_category->pdf('blog_category', 'blog_category');
	}
}


/* End of file blog_category.php */
/* Location: ./application/controllers/Blog Category.php */