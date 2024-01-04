<?php

class GantiPassword extends CI_Controller {

	public function index() 
	{
		$data['title'] = "Form Ganti Password";

		$this->load->view('templates_karyawan/header',$data);
		$this->load->view('templates_karyawan/sidebar');
		$this->load->view('gantiPassword', $data);
		$this->load->view('templates_karyawan/footer');
	}

	public function gantiPasswordAksi()
	{
		$passBaru = $this->input->post('passBaru');
		$ulangPass = $this->input->post('ulangPass');

		$this->form_validation->set_rules('passBaru','Password Baru','required|matches[ulangPass]',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('ulangPass','Ulangi Password Baru','required',
        array('required' => '%s Harus di isi terlebih dahulu'));

		if($this->form_validation->run() != FALSE) {
            $data = array('password' => md5($passBaru));
			$id = array('id_karyawan' => $this->session->userdata('id_karyawan'));
			$this->penggajianModel->update_data('data_karyawan', $data, $id);
            $_SESSION['bl'] = "Password Anda Berhasil di Ganti, Silahkan Login Kembali!";
			redirect('welcome');
		}else{
			$data['title'] = "Form Ganti Password";

			$this->load->view('templates_karyawan/header',$data);
			$this->load->view('templates_karyawan/sidebar');
			$this->load->view('gantiPassword', $data);
			$this->load->view('templates_karyawan/footer');
		}
	}
}

?>