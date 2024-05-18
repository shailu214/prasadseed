<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		//$this->load->model('custom');
		$this->pageParam->nav = 'entry';
		$this->pageParam->role = $_SESSION[ADMIN]['role'];
	}

	
	public function index( $pg=null ) {
		$post = $this->input->get('data');
		$request = http_build_query($_GET);
		if(!empty( $post )) {
			if($post['search_year'] != '') {
				$this->db->where('year(year)', $post['search_year']);
			}
			if($post['farmer_id'] != '') {
				$this->db->where('farmer_id', $post['farmer_id']);
			}
		}
		$rows = $this->db->get('entry_management')->num_rows();
		$lim = 10;
		
		
		if(!empty( $post )) {
			if($post['search_year'] != '') {
				$this->db->where('year(year)', $post['search_year']);
			}
			if($post['farmer_id'] != '') {
				$this->db->where('farmer_id', $post['farmer_id']);
			}
		}
		
		$this->load->library('pagination');
		$config['suffix'] = '?'.$request;
		$config['base_url'] = base_url().'entry/index/';
		$config['total_rows'] = $rows;
		$config['per_page'] = $lim;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="javascript:;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$pages = $this->pagination->create_links();

		if($pg>0) { $pg--; }
		$start = $pg*$lim;


		$this->db->order_by("id","desc");
		$this->db->limit($lim,$start);

		$data['result'] = $this->db->get("entry_management")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;
		$data['db'] = $this->db;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/entry/view',$data);
		$this->load->view('admin/footer');
	}
	
	public function lot($id) {
		$this->db->select('sell.*');
		$this->db->where('farmer_lots.entry_management_id', $id);
		$this->db->join('farmer_lots', 'farmer_lots.id = sell.farmer_lot_id');
		$data = [];
		$data['lots'] = $this->db->get("sell")->result();
		
		//$data['db'] => $this->db;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/entry/lot',$data);
		$this->load->view('admin/footer');
	
	}
	
	public function view($id) {
		$this->db->where('id', $id);
		$obj = $this->db->get("entry_management")->row();
		
		$this->db->where('id', $obj->farmer_id);
		$farmer = $this->db->get("farmer")->row();
		
		$shortQty = 0;
		
		if($farmer) {
			$this->db->where('farmer_lot_id', $obj->id);
			$this->db->where('farmer_id', $obj->farmer_id);
			$sell = $this->db->get("sell")->row();
			if($sell) {
				$shortQty = $sell->short_qty;
			}
			/*
			$this->db->where('entry_management_id', $obj->id);
			$this->db->where('farmer_id', $obj->farmer_id);
			$farmer_lots = $this->db->get("farmer_lots")->row();
			if($farmer_lots) {
				
			}
			*/
			
			
			$obj->farmer_id = $farmer->name;
			$obj->mobile_no = $farmer->mobile;
			$obj->father = $farmer->father_name;
			$obj->reference = $farmer->reference_name;
			$obj->address = $farmer->address;
		
		}
		$this->db->where('id', $obj->address);
		$address = $this->db->get("address")->row();
		if($address) {
			$obj->farmer_address = $address->address;
		}

		$this->db->where('id', $obj->vegetable_id);
		$vegetable = $this->db->get("vegetable")->row();
		if($vegetable) {
			$obj->vegetable_id = $vegetable->name;
		}
		
		$this->db->where('id', $obj->variety_id);
		$variety = $this->db->get("vegetable_variety")->row();
		if($variety) {
			$obj->variety_id = $variety->name;
		}

		$this->db->where('entry_management_id', $obj->id);
		$entry = $this->db->get("entry_management_detail")->result_array();
		//echo '<pre>'; print_r($entry); die;
		$data = ['obj' => $obj, 'shortQty' => $shortQty, 'entry' => $entry, 'db' => $this->db];
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/entry/info',$data);
		$this->load->view('admin/footer');
	}


	public function add($id = null)
	{

		$post = $this->input->post('data');
		if(!empty($post)) {
			if($this->pageParam->role != 1) {
				redirect("entry");
			}
			$errors = [];
			if(empty($post['year'])) {
				$errors[] = 'Year is required';
			}
			if(empty($post['vegetable_id'])) {
				$errors[] = 'vegetable Name is required';
			}
			if(empty($post['variety_id'])) {
				$errors[] = 'vegetable variety is required';
			}
			if(empty($post['farmer_id'])) {
				$errors[] = 'Farmer Name is required';
			}

			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("entry/add");
			}
			
			$pkid = $this->input->post('pkid');
			if($pkid > 0) {
				$this->db->where('id', $pkid);
				$obj =  $this->db->get('entry_management')->row();
				if($obj == null) {
					redirect("entry");
				}
				if($post['sno'] != '') {
					$this->db->where('farmer_id <>', $obj->farmer_id);
					$this->db->where('sno', $post['sno']);
					$objfindsno =  $this->db->get('entry_management')->row();
					if($objfindsno) {
						$errors[] = 'S.No '.$post['sno'].' already used';
						$this->session->set_flashdata('errors', $errors);
						redirect("entry/add/".$obj->id);
					}
				}
				
			} else {
				if($post['sno'] != '') {
					$this->db->where('farmer_id <>', $post['farmer_id']);
					$this->db->where('sno', $post['sno']);
					$objfindsno =  $this->db->get('entry_management')->row();
					if($objfindsno) {
						$errors[] = 'S.No '.$post['sno'].' already used';
						$this->session->set_flashdata('errors', $errors);
						redirect("entry/add/".$obj->id);
					}
				}
			}
			
			$msg = $vegetable_id = $variety_id = $title_category_id = $title_category_value_id = 
			$type_id = $type_value_id = '';
			
			$flagt = $this->handleType($msg, $type_id, $type_value_id);
			if($flagt == false) {
				
				/* $errors[] = $msg;
				$this->session->set_flashdata('errors', $errors);
				redirect("entry/add"); */
			}
			
			$flag = $this->handleTitle($msg, $title_category_id, $title_category_value_id);
			if($flag == false) {
				/* $errors[] = $msg;
				$this->session->set_flashdata('errors', $errors);
				redirect("entry/add"); */
			}
			
			$flagv = $this->handleVagitable($msg, $vegetable_id, $variety_id);
			if($flagv == false) {
				$errors[] = $msg;
				$this->session->set_flashdata('errors', $errors);
				redirect("entry/add");
			}
			
			if($vegetable_id > 0 && $variety_id > 0) {
				$post['lot_no'] = 0;
				if($post['sno'] > 0 && $post['qty'] > 0) {
					$post['lot_no'] = $post['sno']-$post['qty'];
				}
				if($title_category_id > 0 && $title_category_value_id > 0) {
					$post['title_category_id'] = $title_category_id;
					$post['title_category_value_id'] = $title_category_value_id;
				} else {
					$post['title_category_id'] = null;
					$post['title_category_value_id'] = null;
				}
				
				if($type_id > 0 && $type_value_id > 0) {
					$post['type_id'] = $type_id;
					$post['type_value_id'] = $type_value_id;
				} else {
					$post['type_id'] = null;
					$post['type_value_id'] = null;
				}
				$post['vegetable_id'] = $vegetable_id;
				$post['variety_id'] = $variety_id;
				
				
				
				if($pkid > 0) {
					$this->db->where('id', $pkid);
					$this->db->update('entry_management', $post);
					$this->session->set_flashdata('success_entry', 'success');
					redirect("entry/add/".$pkid);
				} else {
					
					if($post['sno'] != '') {
						$this->db->where('sno', $post['sno']);
						$obj =  $this->db->get('entry_management')->row();
						if($obj == null) {
							$this->db->insert("entry_management", $post );
							$lastid = $this->db->insert_id();
							$this->session->set_flashdata('success_entry', 'success');
							$lot = $post['sno'].'/'.$post['qty'];
							$params = ['farmer_id' => $post['farmer_id'], 'lots' => $lot, 'entry_management_id' => $lastid];
							$this->db->insert("farmer_lots", $params );
						} else {
							$errors[] = 'S.No already used';
							$this->session->set_flashdata('errors', $errors);
							redirect("entry/add");
						}
					}
					
					redirect("entry/add");
				}
				
			}
			
		}
		
		$this->db->where('id', $id);
		$data['obj'] =  $this->db->get('entry_management')->row();
		$data['db'] = $this->db;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/entry/add',$data);
		$this->load->view('admin/footer');
	}
	
	public function verify() {
		$pkid = $this->input->post('pkid');
		$comment = $this->input->post('comment');
		if($comment == '') {
			echo json_encode(['status' => 'error', 'message' => 'Please enter message']);
			die;
		}

		$this->db->where('id', $pkid);
		$entry = $this->db->get('entry_management')->row();

		if($entry == null) {
			echo json_encode(['status' => 'error', 'message' => 'Record not found']);
			die;
		}

		$this->db->where('id', $pkid);
		$status = $this->db->update('entry_management', ['comment' => $comment, 'verify' => 2]);
		if($status) {
			echo json_encode(['status' => 'success', 'message' => 'Record not found']);
			die;
		}
		echo json_encode(['status' => 'error', 'message' => 'Something wrong plz try again']);
		die;
	}
	
	public function handleType(&$msg, &$type_id, &$type_value_id) {
		$post = $this->input->post('data');
		$type = $post['type_id'];
		$type_value = $post['type_value_id'];
		if($type > 0) {
			$this->db->where('id', $type);
			$typeObj = $this->db->get('type')->row();
			if($typeObj == null) {
				$msg = 'Type not found in database';
				return false;
			}
			$type_id = $typeObj->id;
		} else {
			$type_name = $this->input->post('type_name');
			$this->db->insert("type", ['name' => $type_name] );
			$type_id_last_id = $this->db->insert_id();
			if($type_id_last_id > 0) {
				$type_id = $type_id_last_id;
			} else {
				$msg = 'Something wrong';
				return false;
			}
		}
		
		if($type_value > 0) {
			$this->db->where('id', $type_value);
			$typeValueObj = $this->db->get('type_value')->row();
			if($typeValueObj == null) {
				$msg = 'Type Value not found in database';
				return false;
			}
			$type_value_id = $typeValueObj->id;
		} else {
			$type_value_name = $this->input->post('type_value_name');
			$this->db->insert("type_value", ['type_id' => $type_id, 'name' => $type_value_name] );
			$lastid = $this->db->insert_id();
			if($lastid > 0) {
				$type_value_id = $lastid;
			} else {
				$msg = 'Something wrong';
				return false;
			}
		}
		
		return true;
	}
	
	public function handleTitle(&$msg, &$title_category_id, &$title_category_value_id) {
		$post = $this->input->post('data');
		$title_category = $post['title_category_id'];
		$title_category_value = $post['title_category_value_id'];
		if($title_category > 0) {
			$this->db->where('id', $title_category);
			$titleCategoryObj = $this->db->get('title_category')->row();
			if($titleCategoryObj == null) {
				$msg = 'Title Category not found in database';
				return false;
			}
			$title_category_id = $titleCategoryObj->id;
		} else {
			$title_category_name = $this->input->post('title_category_name');
			$this->db->insert("title_category", ['name' => $title_category_name] );
			$title_category_id_last_id = $this->db->insert_id();
			if($title_category_id_last_id > 0) {
				$title_category_id = $title_category_id_last_id;
			} else {
				$msg = 'Something wrong';
				return false;
			}
		}
		
		if($title_category_value_id > 0) {
			$this->db->where('id', $title_category_value_id);
			$titleCategoryValueObj = $this->db->get('title_category_value')->row();
			if($titleCategoryValueObj == null) {
				$msg = 'Title Category Value not found in database';
				return false;
			}
			$title_category_value_id = $titleCategoryValueObj->id;
		} else {
			$title_category_value_name = $this->input->post('title_category_value_name');
			//if($title_category_value_name != '') {
				$this->db->insert("title_category_value", ['title_category_id' => $title_category_id, 'name' => $title_category_value_name] );
				$lastid = $this->db->insert_id();
				if($lastid > 0) {
					$title_category_value_id = $lastid;
				} else {
					$msg = 'Something wrong';
					return false;
				}
			//}
		}
		
		return true;
	}
	
	public function handleVagitable(&$msg, &$vegetableId, &$varietyId) {
		
		$post = $this->input->post('data');
		$vegetable_id = $post['vegetable_id'];
		$variety_id = $post['variety_id'];
		if($vegetable_id > 0) {
			$this->db->where('id', $vegetable_id);
			$vegetableObj = $this->db->get('vegetable')->row();
			if($vegetableObj == null) {
				$msg = 'Vegetable not found in database';
				return false;
			}
			$vegetableId = $vegetable_id;
		} else {
			$vegetable_name = $this->input->post('vegetable_name');
			$this->db->insert("vegetable", ['name' => $vegetable_name] );
			$vegetable_id = $this->db->insert_id();
			if($vegetable_id > 0) {
				$vegetableId = $vegetable_id;
			} else {
				$msg = 'Something wrong';
				return false;
			}
		}
		
		if($variety_id > 0) {
			$this->db->where('id', $variety_id);
			$vegetableObj = $this->db->get('vegetable_variety')->row();
			if($vegetableObj == null) {
				$msg = 'Vegetable Variety not found in database';
				return false;
			}
			$varietyId = $variety_id;
		} else {
			$variety_name = $this->input->post('variety_name');
			$this->db->insert("vegetable_variety", ['vegetable_id' => $vegetableId, 'name' => $variety_name] );
			$variety_id = $this->db->insert_id();
			if($variety_id > 0) {
				$varietyId = $variety_id;
			} else {
				$msg = 'Something wrong';
				return false;
			}
		}
		
		return true;
	}

	public function farmerajax()
	{
		$term = $this->input->post('searchTerm');
		$this->db->select('farmer.*, address.address as addr');
		$this->db->like('farmer.name', $term);
		$this->db->or_like('address.address', $term);
		$this->db->or_like('farmer.mobile', $term);
		$this->db->or_like('farmer.father_name', $term);
		$this->db->or_like('farmer.reference_name', $term);
		$this->db->limit(5);
		$this->db->join('address', 'address.id = farmer.address');
		$data = $this->db->get('farmer');
		$result = [];
		foreach($data->result_array() as $val) {
			$string = $val['name'].', '.$val['mobile'];
			if($val['father_name'] != null) {
				$string .= ', '.$val['father_name'];
			}
			if($val['reference_name'] != null) {
				$string .= ', '.$val['reference_name'];
			}
			$string .= ', '.$val['addr'];
			$lots = [];
			$this->db->where('farmer_id', $val['id']);
			$data = $this->db->get('farmer_lots');
			foreach($data->result_array() as $obj) {
			
				$lots[] = ['id' => $obj['id'], 'lots' => $obj['lots']];
			}
			$result[] = ['id' => $val['id'], 'search' => $string, 'lots' => $lots];
		}
		echo json_encode($result);
	}
	
	public function vegetableajax()
	{
		$term = $this->input->post('searchTerm');
		
		$this->db->like('name', $term);
		$this->db->limit(5);
		$data = $this->db->get('vegetable');
		$result = [];
		
		if($data->num_rows() == 0) {
			$result[] = ['id' => -1, 'name' => $term];
			echo json_encode($result);
		} else {
			foreach($data->result_array() as $val) {
				$result[] = ['id' => $val['id'], 'name' => $val['name']];
			}
			echo json_encode($result);
		}
		
	}
	
	public function varietyajax()
	{
		$term = $this->input->post('searchTerm');
		$vegetable_id = $this->input->post('searchId');
		$result = [];
		
		if($vegetable_id > 0) {
			$this->db->where('vegetable_id', $vegetable_id);
			$this->db->like('name', $term);
			$this->db->limit(5);
			$data = $this->db->get('vegetable_variety');
			
			
			if($data->num_rows() == 0) {
				$result[] = ['id' => -1, 'name' => $term];
				echo json_encode($result);
			} else {
				foreach($data->result_array() as $val) {
					$result[] = ['id' => $val['id'], 'name' => $val['name']];
				}
				echo json_encode($result);
			}
		} else {
			$result[] = ['id' => -1, 'name' => $term];
			echo json_encode($result);
		}
	}
	
	public function typeajax()
	{
		$term = $this->input->post('searchTerm');
		$result = [];
		$this->db->like('name', $term);
		$this->db->limit(5);
		$data = $this->db->get('type');
		
		if($data->num_rows() == 0) {
			$result[] = ['id' => -1, 'name' => $term];
			echo json_encode($result);
		} else {
			foreach($data->result_array() as $val) {
				$result[] = ['id' => $val['id'], 'name' => $val['name']];
			}
			echo json_encode($result);
		}
		
	}
	public function typevalueajax()
	{
		$term = $this->input->post('searchTerm');
		$result = [];
		$type_id = $this->input->post('type_id');
		if($type_id > 0) {
			$this->db->where('type_id', $type_id);
			$this->db->like('name', $term);
			$this->db->limit(5);
			$data = $this->db->get('type_value');
			
			if($data->num_rows() == 0) {
				$result[] = ['id' => -1, 'name' => $term];
				echo json_encode($result);
			} else {
				foreach($data->result_array() as $val) {
					$result[] = ['id' => $val['id'], 'name' => $val['name']];
				}
				echo json_encode($result);
			}
		} else {
			$result[] = ['id' => -1, 'name' => $term];
			echo json_encode($result);
		}
	}
	
	public function title_category()
	{
		$term = $this->input->post('searchTerm');
		$result = [];
		
		$this->db->like('name', $term);
		$this->db->limit(5);
		$data = $this->db->get('title_category');
		
		
		if($data->num_rows() == 0) {
			$result[] = ['id' => -1, 'name' => $term];
			echo json_encode($result);
		} else {
			foreach($data->result_array() as $val) {
				$result[] = ['id' => $val['id'], 'name' => $val['name']];
			}
			echo json_encode($result);
		}
	}
	
	public function title_category_value()
	{
		$term = $this->input->post('searchTerm');
		$result = [];
		$title_category_id = $this->input->post('title_category_id');
		if($title_category_id > 0) {
			$this->db->where('title_category_id', $title_category_id);
			$this->db->like('name', $term);
			$this->db->limit(5);
			$data = $this->db->get('title_category_value');
			
			
			if($data->num_rows() == 0) {
				$result[] = ['id' => -1, 'name' => $term];
				echo json_encode($result);
			} else {
				foreach($data->result_array() as $val) {
					$result[] = ['id' => $val['id'], 'name' => $val['name']];
				}
				echo json_encode($result);
			}
		} else {
			$result[] = ['id' => -1, 'name' => $term];
			echo json_encode($result);
		}
	}
	
	public function delete($entryid) {
		if($this->pageParam->role == 1) {
			$this->db->where('id', $entryid);
			$entry = $this->db->get('entry_management')->row();
			if($entry) {
				$this->db->where('id', $entryid);
				$this->db->delete('entry_management');
			}
		}
		redirect("entry");
	}
}
