<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	 public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') != '1'){
			$_SESSION['gl'] = "Anda Belum Login!";
				redirect('welcome');
		}
	}
	public function index()
	{
		$data['title'] = "Dashboard";
		$karyawan = $this->db->query("SELECT * FROM data_karyawan");
		$admin = $this->db->query("SELECT * FROM hak_akses WHERE keterangan = 'admin'");
		$jabatan = $this->db->query("SELECT * FROM data_jabatan");
		$kehadiran = $this->db->query("SELECT * FROM data_kehadiran");

		$data['karyawan'] = $karyawan->num_rows();
		$data['admin'] = $admin->num_rows();
		$data['jabatan'] = $jabatan->num_rows();
		$data['kehadiran'] = $kehadiran->num_rows();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates_admin/footer');
	}
}