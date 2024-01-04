<?php

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') != '2'){
			$_SESSION['gl'] = "Anda Belum Login!";
				redirect('login');
		}
	}
	public function index() 
	{
		$data['title'] = "Dashboard";
		$id=$this->session->userdata('id_karyawan');
		$data['karyawan'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan='$id'")->result();

		$this->load->view('templates_karyawan/header',$data);
		$this->load->view('templates_karyawan/sidebar');
		$this->load->view('karyawan/dashboard', $data);
		$this->load->view('templates_karyawan/footer');
	}
}

?>