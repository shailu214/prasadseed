<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bardana extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		//if($_SESSION[ADMIN]['role'] != 1 && !in_array(1,$_SESSION[ADMIN]['prms'])) { redirect('dashboard'); }
		//$this->load->model('custom');
		$this->pageParam->nav = 'bardana';
		$this->pageParam->role = $_SESSION[ADMIN]['role'];
	}

	
	public function index( $pg=null ) {
		$post = $this->input->get('data');
		$request = http_build_query($_GET);
		
		$farmersearch = $this->input->get('farmersearch');
		if(!empty( $post )) {
			if($post['search_year'] != '') {
				$this->db->where('year(year)', $post['search_year']);
			}
			
			if($post['farmer_id'] != '') {
				$this->db->where('farmer_id', $post['farmer_id']);
			}
		}
		if($farmersearch == 1) {
			$this->db->where('em.id IS NULL');

			$this->db->where('em.farmer_id IS NULL', null, false);
			$this->db->join('entry_management as em', 'bardana.farmer_id = em.farmer_id', 'left'); 
		}
		$rows = $this->db->get('bardana')->num_rows();
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
		$config['base_url'] = base_url().'bardana/index/';
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
		$this->db->select('bardana.*');
		if($farmersearch == 1) {
			$this->db->where('em.id IS NULL');

			$this->db->where('em.farmer_id IS NULL', null, false);
			$this->db->join('entry_management as em', 'bardana.farmer_id = em.farmer_id', 'left'); 
		}
		$data['result'] = $this->db->get("bardana")->result_array();
		$data['pages'] = $pages;
		$data['sno'] = $start;
		$data['db'] = $this->db;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/bardana/view',$data);
		$this->load->view('admin/footer');
	}
	
	public function view($id) {
		$this->db->where('id', $id);
		$obj = $this->db->get("bardana")->row();
		
		$this->db->where('id', $obj->farmer_id);
		$farmer = $this->db->get("farmer")->row();
		if($farmer) {
			$obj->farmer_id = $farmer->name;
		}

		$this->db->where('id', $obj->vegetable_id);
		$vegetable = $this->db->get("vegetable")->row();
		if($vegetable) {
			$obj->vegetable_id = $vegetable->name;
		}


		$this->db->where('bardana_id', $id);
		$details = $this->db->get("bardana_detail")->result_array();
		
		$data = ['obj' => $obj, 'details' => $details];
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/bardana/info',$data);
		$this->load->view('admin/footer');
	}
	
	public function returnlist($id) {
		
		$this->db->where('type', 1);
		$this->db->where('bardana_detail_id', $id);
		$list = $this->db->get("bardana_detail_return")->result();
		
		$this->db->where('type', 2);
		$this->db->where('bardana_detail_id', $id);
		$list_two = $this->db->get("bardana_detail_return")->result();
		
		$this->db->where('type', 3);
		$this->db->where('bardana_detail_id', $id);
		$list_three = $this->db->get("bardana_detail_return")->result();
		
		$this->db->where('type', 4);
		$this->db->where('bardana_detail_id', $id);
		$list_four = $this->db->get("bardana_detail_return")->result();
		
		$data = [
			'list' => $list,
			'list_two' => $list_two,
			'list_three' => $list_three,
			'list_four' => $list_four,
		];
		
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/bardana/returnlist',$data);
		$this->load->view('admin/footer');
	}

	public function return($id) {
		$bardana_id = $this->input->post('bardana_id');
		$return_date = $this->input->post('return_date');
		$return_qty = $this->input->post('return_qty');
		$type = $this->input->post('type');
		$this->db->where('id', $id);
		$list = $this->db->get("bardana")->row();
		if(!empty($bardana_id) && !empty($return_date) && !empty($return_qty)) {
			
			$status = false;
			//echo '<pre>'; print_r($list->qty); die;
			$this->db->where('bardana_id', $list->id);
			$this->db->where('type', $type);
			$this->db->select_sum('return_qty');
			$total = $this->db->get("bardana_detail_return")->row();
			$qty = $list->qty;
			if($type == 2) {
				$qty = $list->qty_two;
			} else if($type == 3) {
				$qty = $list->qty_three;
			} if($type == 4) {
				$qty = $list->qty_four;
			}
			if($total->return_qty > 0) {
				
				if($qty < ($total->return_qty+$return_qty)) {
					$this->session->set_flashdata('errors_'.$type, ['Qty should be '.($qty-$total->return_qty)]);
					redirect("bardana/return/".$id);
				}
			} else {
				if($qty < $return_qty) { 
					$this->session->set_flashdata('errors_'.$type, ['Qty should be '.$qty]);
					redirect("bardana/return/".$id);
				}
			}
			
			//$bardana_id.' '.$return_qty.' '.$return_date; die;
			$status = true;
			$this->db->insert("bardana_detail_return", [
				'type' => $type,
				'bardana_id' => $bardana_id,
				'return_qty' => $return_qty,
				'return_date' => $return_date,
			]);
			
			if($status === true) {
				$this->session->set_flashdata('success_entry', 'success');
			} else {
				$this->session->set_flashdata('errors_'.$type, ['Please Try Again']);
			}
			redirect("bardana/return/".$id);
		}
		
		$this->db->where('bardana_id', $id);
		$this->db->where('type', 1);
		$returnlist = $this->db->get("bardana_detail_return")->result_array();
		
		$this->db->where('bardana_id', $id);
		$this->db->where('type', 2);
		$returnlist_two = $this->db->get("bardana_detail_return")->result_array();
		
		$this->db->where('bardana_id', $id);
		$this->db->where('type', 3);
		$returnlist_three = $this->db->get("bardana_detail_return")->result_array();
		
		
		$this->db->where('bardana_id', $id);
		$this->db->where('type', 4);
		$returnlist_four = $this->db->get("bardana_detail_return")->result_array();
		
		$data = [
					'id' => $id,
					'list' => $list,
					'returnlist' => $returnlist,
					'returnlist_two' => $returnlist_two,
					'returnlist_three' => $returnlist_three,
					'returnlist_four' => $returnlist_four
				];
		//echo '<pre>'; print_r($returnlist); die;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/bardana/return',$data);
		$this->load->view('admin/footer');
	}
	
	public function add($id = null)
	{
		$post = $this->input->post('data');
		$weight = $this->input->post('title');
		$weight_value = $this->input->post('value');
		$value = $this->input->post('val');
		if(!empty($post)) {
			if($this->pageParam->role != 1) {
				redirect("bardana");
			}
			
			$errors = [];
			if(empty($post['year'])) {
				$errors[] = 'Year is required';
			}
			if(empty($post['farmer_id'])) {
				$errors[] = 'Farmer Name is required';
			}
			
			//echo '<pre>'; print_r($post); die;
			if(count($errors) > 0) {
				$this->session->set_flashdata('errors', $errors);
				redirect("bardana/add");
			}
			
			
			$pkid = $this->input->post('pkid');
			$this->db->where('id', $pkid);
			$obj = $this->db->get('bardana')->row();
			if($obj) {
				$this->session->set_flashdata('success_entry', 'success update');
				$this->db->where('id', $pkid);
				$this->db->update('bardana', $post);
				$lastid = $obj->id;
			} else {
				$this->session->set_flashdata('success_entry', 'success');
				$this->db->insert("bardana", $post );
				$lastid = $this->db->insert_id();
			}
			
			if($lastid > 0) { 
				$arr = [];
				
				foreach((array) $weight as $k => $weightarr) {
					$weight_value2 = $value2 = '';
					$weightval = $weightarr;
					if(isset($weight_value[$k]) && !empty($weight_value[$k])) {
						$weight_value2 = $weight_value[$k];
					}
					if(isset($value[$k]) && !empty($value[$k])) {
						$value2 = $value[$k];
					}
					
					if(!empty($weightval)) {
						$arr = [
							'bardana_id' => $lastid,
							'title' => $weightval,
							'value' => $weight_value2,
							'val' => $value2
						];
						if($k > 0) {
							$this->db->where('id', $k);
							$objdata = $this->db->get('bardana_detail')->row();
							if($objdata) {
								$this->db->where('id', $objdata->id);
								$this->db->update('bardana_detail', $arr);
							}
						} else {
							$this->db->insert("bardana_detail",$arr);
						}
						
					}
				}
			}
			
			if(obj) {
				redirect("bardana/add/".$obj->id);
			}
			redirect("bardana/add");
				
		}
		$data['obj'] = null;
		$data['bardana_details'] = [];
		if($id > 0) {
			$this->db->where('id', $id);
			$obj = $this->db->get('bardana')->row();
			$data['obj'] = $obj;
			if($obj) {
				$this->db->where('bardana_id', $id);
				$data['bardana_details'] = $this->db->get('bardana_detail')->result_array();
			}
			
		}
		$data['db'] = $this->db;
		//echo '<pre>'; print_r($data['bardana_details']); die;
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/bardana/add',$data);
		$this->load->view('admin/footer');
	}

	public function farmerajax()
	{
		$term = $this->input->post('searchTerm');
		
		$this->db->like('name', $term);
		$this->db->or_like('mobile', $term);
		$this->db->or_like('father_name', $term);
		$this->db->or_like('reference_name', $term);
		$this->db->limit(5);
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
			$result[] = ['id' => $val['id'], 'search' => $string];
		}
		echo json_encode($result);
	}
	
	public function delete($bardanaid) {
		if($this->pageParam->role == 1) {
			$this->db->where('id', $bardanaid);
			$bardana = $this->db->get('bardana')->row();
			if($bardana) {
				
				$this->db->where('bardana_id', $bardana->id);
				$this->db->delete('bardana_detail_return');
				
				$this->db->where('id', $bardana->id);
				$this->db->delete('bardana');
			}
		}
		
		redirect("bardana");
	}
}
