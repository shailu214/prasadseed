<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if( $this->cmsval->validateApp() ) {
			redirect('login');
		}
		if(empty($_SESSION[ADMIN])) { redirect(''); }
		if($_SESSION[ADMIN]['role'] != 1 ) { redirect('dashboard'); }
		$this->load->model('custom');
		$this->custom->setConfig();
		$this->notify->getFeeInfo();
		$this->notify->getStdInfo();
	}


	public function index( ) {

		$post = $this->input->post('set');

			// print_r($post);
		if(!empty($post)) {
			if(strlen($_FILES['logo']['name'])) {
				$ext = pathinfo($_FILES['logo']['name']);
				$ext = $ext['extension'];
				$img = "my-logo.".$ext;
				move_uploaded_file($_FILES['logo']['tmp_name'], "media/config/".$img);
				$post['logo'] = $img;
			}
			if($this->db->get("config")->num_rows()) {
				$this->db->update("config", $post, "id>0");
			} else {
				$this->db->insert("config", $post);
			}
			$alt = 1;

		}

		$data = $this->db->get("config")->row_array();
		$data['alert'] = $alt;

		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/profile',$data);
		$this->load->view('admin/footer');
	}



	public function download () {
		$this->load->dbutil();

        $prefs = array(
                'format'      => 'zip',
                'filename'    => 'database.sql'
              );


        $backup =& $this->dbutil->backup($prefs);

        $db_name = 'data-backup-'.date('M-Y').'.zip';
        $save = 'pathtobkfolder/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup);


        $this->load->helper('download');
        force_download($db_name, $backup);
	}


}
