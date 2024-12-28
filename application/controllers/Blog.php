<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Blog Controller
*| --------------------------------------------------------------------------
*| Blog site
*|
*/
class Blog extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_blog');
	}

	/**
	* show all Blogs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('blog_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['blogs'] = $this->model_blog->get($filter, $field, $this->limit_page, $offset);
		$this->data['blog_counts'] = $this->model_blog->count_all($filter, $field);

		$config = [
			'base_url'     => 'blog/index/',
			'total_rows'   => $this->model_blog->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Blog List');
		$this->render('backend/app-menu/blog/blog_list', $this->data);
	}
	
	/**
	* Add new blogs
	*
	*/
	public function add()
	{
		$this->is_allowed('blog_add');

		$this->template->title('Blog New');
		$this->render('backend/app-menu/blog/blog_add', $this->data);
	}

	/**
	* Add New Blogs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('blog_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('blog_image_name', 'Image', 'trim');
		$this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[200]');
		

		if ($this->form_validation->run()) {
			$blog_image_uuid = $this->input->post('blog_image_uuid');
			$blog_image_name = $this->input->post('blog_image_name');
		
			$save_data = [
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'category' => $this->input->post('category'),
			];

			if (!is_dir(FCPATH . '/uploads/blog/')) {
				mkdir(FCPATH . '/uploads/blog/');
			}

			if (!empty($blog_image_name)) {
				$blog_image_name_copy = date('YmdHis') . '-' . $blog_image_name;

				rename(FCPATH . 'uploads/tmp/' . $blog_image_uuid . '/' . $blog_image_name, 
						FCPATH . 'uploads/blog/' . $blog_image_name_copy);

				if (!is_file(FCPATH . '/uploads/blog/' . $blog_image_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Kesalahan mengunggah gambar'
						]);
					exit;
				}

				$save_data['image'] = $blog_image_name_copy;
			}
		
			
			$save_blog = $this->model_blog->store($save_data);

			if ($save_blog) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_blog;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('blog/edit/' . $save_blog, 'Edit blog').' atau  '.anchor('blog', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('blog/edit/' . $save_blog, 'Edit blog'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('blog');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('blog');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Blogs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('blog_update');

		$this->data['blog'] = $this->model_blog->find($id);

		$this->template->title('Blog Update');
		$this->render('backend/app-menu/blog/blog_update', $this->data);
	}

	/**
	* Update Blogs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('blog_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('blog_image_name', 'Image', 'trim');
		$this->form_validation->set_rules('category', 'Category', 'trim|required|max_length[200]');
		
		if ($this->form_validation->run()) {
			$blog_image_uuid = $this->input->post('blog_image_uuid');
			$blog_image_name = $this->input->post('blog_image_name');
		
			$save_data = [
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'category' => $this->input->post('category'),
			];

			if (!is_dir(FCPATH . '/uploads/blog/')) {
				mkdir(FCPATH . '/uploads/blog/');
			}

			if (!empty($blog_image_uuid)) {
				$blog_image_name_copy = date('YmdHis') . '-' . $blog_image_name;

				rename(FCPATH . 'uploads/tmp/' . $blog_image_uuid . '/' . $blog_image_name, 
						FCPATH . 'uploads/blog/' . $blog_image_name_copy);

				if (!is_file(FCPATH . '/uploads/blog/' . $blog_image_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Kesalahan mengunggah gambar'
						]);
					exit;
				}

				$save_data['image'] = $blog_image_name_copy;
			}
		
			
			$save_blog = $this->model_blog->change($id, $save_data);

			if ($save_blog) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('blog', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('blog');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('blog');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Blogs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('blog_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('blog');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data blog berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data blog.', 'error');
		}

		redirect('blog');
	}

		/**
	* View view Blogs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('blog_view');

		$this->data['blog'] = $this->model_blog->find($id);

		$this->template->title('Blog Detail');
		$this->render('backend/app-menu/blog/blog_view', $this->data);
	}
	
	/**
	* delete Blogs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$blog = $this->model_blog->find($id);

		if (!empty($blog->image)) {
			$path = FCPATH . '/uploads/blog/' . $blog->image;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_blog->remove($id);
	}
	
	/**
	* Upload Image Blog	* 
	* @return JSON
	*/
	public function upload_image_file()
	{
		if (!$this->is_allowed('blog_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'blog',
			'allowed_types' => 'jpg|jpeg|png',
			'max_size' 	 	=> 2000,
		]);
	}

	/**
	* Delete Image Blog	* 
	* @return JSON
	*/
	public function delete_image_file($uuid)
	{
		if (!$this->is_allowed('blog_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'image', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'blog',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/blog/'
        ]);
	}

	/**
	* Get Image Blog	* 
	* @return JSON
	*/
	public function get_image_file($id)
	{
		if (!$this->is_allowed('blog_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$blog = $this->model_blog->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'image', 
            'table_name'        => 'blog',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/blog/',
            'delete_endpoint'   => 'blog/delete_image_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('blog_export');

		$this->model_blog->export('blog', 'blog');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('blog_export');

		$this->model_blog->pdf('blog', 'blog');
	}
}


/* End of file blog.php */
/* Location: ./application/controllers/Blog.php */