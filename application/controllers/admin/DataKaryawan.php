<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dataKaryawan extends CI_Controller {

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
        $data['title'] = 'Data Karyawan';
        $data['karyawan'] = $this->penggajianModel->get_data('data_karyawan')->result();

        $this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataKaryawan', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambahData()
	{   
        $data['title'] = 'Tambah Data Karyawan';
        $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();

        $this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formTambahKaryawan', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambahDataAksi() 
	{
		$this->_rules();
		
		if($this->form_validation->run() == FALSE) {
			$this->tambahData();
		} else {
			$nik 					= $this->input->post('nik');
			$nama_karyawan 			= $this->input->post('nama_karyawan');
			$jenis_kelamin 			= $this->input->post('jenis_kelamin');
			$jabatan 				= $this->input->post('jabatan');
			$tanggal_masuk 			= $this->input->post('tanggal_masuk');
			$status 				= $this->input->post('status');
			$hak_akses 				= $this->input->post('hak_akses');
			$username 				= $this->input->post('username');
			$password 				= md5($this->input->post('password'));
			$photo 					= $_FILES['photo']['name'];

			if($photo=''){}else{
				$config['upload_path']          = './assets/photo/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png';
				$config['max_size']				= '2048';
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('photo')) {
					echo "Photo Gagal di upload";
				}else{
					$photo = $this->upload->data('file_name');
					// $photo = $photo['file_name'];
				}
			}
			
			$data = array(
				'nik' 			=> $nik,
				'nama_karyawan' => $nama_karyawan,
				'jenis_kelamin' => $jenis_kelamin,
				'jabatan' 		=> $jabatan,
				'tanggal_masuk' => $tanggal_masuk,
				'status' 		=> $status,
				'hak_akses' 	=> $hak_akses,
				'username' 		=> $username,
				'password' 		=> $password,
				'photo' 		=> $photo,
			);

			$this->penggajianModel->insert_data($data, 'data_karyawan');
			// $this->session->set_flashdata('success', 
			// '<div class="alert alert-success alert-dismissible fade show" role="alert">
			// 		<strong>Data berhasil di tambahkan!</strong>
			// 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			//   		<span aria-hidden="true">&times;</span>
			// 	</button>
		  	// </div>');
			$_SESSION['tambah'] = "Data berhasil di tambahkan";
			redirect('admin/dataKaryawan');
		}
	}

	// public function updateData($id)
	// {   
	// 	$where = array('id_karyawan' => $id);
    //     $data['title'] = 'Update Data Karyawan';
	// 	$data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
	// 	$data['karyawan'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan='$id'")->result();

    //     $this->load->view('templates_admin/header', $data);
	// 	$this->load->view('templates_admin/sidebar');
	// 	$this->load->view('admin/formUpdateKaryawan', $data);
	// 	$this->load->view('templates_admin/footer');
	// }

	public function updateDataAksi() 
	{
		$this->_rules();
		
		if($this->form_validation->run() == FALSE) {
			$this->index();

			
		} else {
			$id 					= $this->input->post('id_karyawan');
			$nik 					= $this->input->post('nik');
			$nama_karyawan 			= $this->input->post('nama_karyawan');
			$jenis_kelamin 			= $this->input->post('jenis_kelamin');
			$jabatan 				= $this->input->post('jabatan');
			$tanggal_masuk 			= $this->input->post('tanggal_masuk');
			$status 				= $this->input->post('status');
			$hak_akses 				= $this->input->post('hak_akses');
			$username 				= $this->input->post('username');
			$password 				= md5($this->input->post('password'));
			$photo 					= $_FILES['photo']['name'];
			$photo_old 				= $this->input->post('photo_old');

			if($photo){
				$config['upload_path']          = './assets/photo/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['overwrite']        	= true;
				$config['max_size']				= '2048';
				$config['file_name']			= 'karyawan-'.date('ymd').'-'.substr(md5(rand()), 0,10);
				$this->load->library('upload', $config);
				if($this->upload->do_upload('photo')) {					
					$photo = $this->upload->data('file_name');
					// $photo = $photo['file_name'];
					$this->db->set('photo',$photo);
					if (file_exists("./assets/photo/".$photo_old)) {
						unlink("./assets/photo/".$photo_old);
					}
				}else{
					echo $this->upload->display_errors();
				}
			}
			
			$data = array(
				'nik' 			=> $nik,
				'nama_karyawan' => $nama_karyawan,
				'jenis_kelamin' => $jenis_kelamin,
				'jabatan' 		=> $jabatan,
				'tanggal_masuk' => $tanggal_masuk,
				'status' 		=> $status,
				'hak_akses' 	=> $hak_akses,
				'username' 		=> $username,
				'password' 		=> $password,
			);

			$where = array(
				'id_karyawan' => $id
			);

			$this->penggajianModel->update_data('data_karyawan',$data,$where);
			$_SESSION['update'] = "Data berhasil di update";
			redirect('admin/dataKaryawan');
		}
	}

	public function _rules() {
		$this->form_validation->set_rules('nik', 'NIK', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('status', 'Status', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('username', 'Username', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('password', 'Password', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
	}

	public function deleteData($id) {
		$where = array('id_karyawan' => $id);

		$photo = $this->db->select('photo')->from('data_karyawan')->where($where)->get()->row()->photo;
		$file_path = "./assets/photo/".$photo;
		if (file_exists($file_path)) {
			unlink($file_path);
		}

				$this->penggajianModel->delete_data($where, 'data_karyawan');
				$_SESSION['delete'] = "Data berhasil di hapus";
		redirect('admin/datakaryawan');
	}
}