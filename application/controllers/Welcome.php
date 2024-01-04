<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		
		$this->_rules();

		if($this->form_validation->run()==FALSE) {
			$data['title'] = "Form Login";
			$this->load->view('templates_admin/header', $data);
			$this->load->view('formLogin');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cek = $this->penggajianModel->cek_login($username, $password);

			if($cek==FALSE) {
				$_SESSION['gagal'] = "Username atau Password Salah!";
				redirect('welcome'); 
			} else {

				$this->session->set_userdata('hak_akses', $cek->hak_akses);
				$this->session->set_userdata('nama_karyawan', $cek->nama_karyawan);
				$this->session->set_userdata('photo', $cek->photo);
				$this->session->set_userdata('id_karyawan', $cek->id_karyawan);
				$this->session->set_userdata('nik', $cek->nik);
				switch ($cek->hak_akses) {
					case '1': 	redirect('admin/dashboard');
								break;
					case '2': 	redirect('karyawan/dashboard');
								break;
					default:
						break;
				}
			}
		}
	}

	public function _rules() {
		$this->form_validation->set_rules('username', 'Username', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('password', 'Password', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$_SESSION['gagalLogin'] = "Username atau Password Salah!";
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('welcome');	
	}
}
