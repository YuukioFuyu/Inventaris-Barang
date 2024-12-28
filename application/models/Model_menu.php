<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Model_menu extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'menu';
	private $field_search 	= array('label', 'id');

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = '', $field = '')
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "(" . $field . " LIKE '%" . $q . "%' ";
	            } else if ($iterasi == $num) {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%') ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = '', $field = '', $limit = 0, $offset = 0)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "(" . $field . " LIKE '%" . $q . "%' ";
	            } else if ($iterasi == $num) {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%') ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function get_permission_menu($menu_id = false)
	{
		if ($menu_id === false) {
			$menu_id = get_user_data('id');
		}
		$result_perm_menu[] = 0;

		$query = $this->db->get_where('aauth_perm_to_menu', ['menu_id' => $menu_id]);

		foreach ($query->result() as $row) {
			$result_perm_menu[] = $row->perm_id;
		}

		return $result_perm_menu;
	}

	public function get_id_menu_type_by_flag($flag = '')
	{
		$flag = str_replace('-', ' ', $flag);

		$query = $this->db->get_where('menu_type', ['name' => $flag]);

		if ($query->row()) {
			return $query->row()->id;
		}

		return 0;
	}

	public function get_group_menu($menu_id = false)
	{
		if ($menu_id === false) {
			$menu_id = get_user_data('id');
		}
		$result_group_menu = [];
		$menu = $this->find($menu_id);
		if (!$menu) {
			return [];
		}
		$permission = $this->get_permission_by_name('menu_'.$menu->label);
		if (!$permission) {
			return [];
		}
		$query = $this->db->get_where('aauth_perm_to_group', ['perm_id' => $permission->id]);
		foreach ($query->result() as $row) {
			$result_group_menu[] = $row->group_id;
		}

		return $result_group_menu;
	}

	public function get_permission_by_name($perm_name)
	{
		$permission = $this->db->get_where('aauth_perms', ['name' => $perm_name])->row();
		if (!$permission) {
			return [];
		}

		return $permission;
	}

	public function update_child_menu_by_parent($parent)
	{
		$this->db->where('parent', $parent);
        $result = $this->db->update($this->table_name, ['parent' => '0']);

        return $result;
	}

	public function get_color_icon()
	{
		
		$color_icon = ['text-red', 'text-yellow', 'text-aqua', 'text-blue', 'text-black', 'text-light-blue', 'text-green', 'text-gray', 'text-navy', 'text-teal', 'text-olive', 'text-lime', 'text-orange', 'text-fuchsia', 'text-purple', 'text-maroon',];

        return $color_icon;
	}

}

/* End of file Model_menu.php */
/* Location: ./application/models/Model_menu.php */