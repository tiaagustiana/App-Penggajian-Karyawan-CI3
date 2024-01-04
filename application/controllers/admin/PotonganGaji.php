<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PotonganGaji extends CI_Controller {

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
        $data['title'] = 'Setting Potongan Gaji';
        $data['pot_gaji'] = $this->penggajianModel->get_data('potongan_gaji')->result();

        $this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/potonganGaji', $data);
		$this->load->view('templates_admin/footer');
	}

    public function tambahData()
	{   
        $data['title'] = 'Tambah Potongan Gaji';

        $this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formPotonganGaji', $data);
		$this->load->view('templates_admin/footer');
	}

    public function tambahDataAksi() 
	{
		$this->_rules();
		
		if($this->form_validation->run() == FALSE) {
			$this->tambahData();
		} else {
			$potongan       = $this->input->post('potongan');
			$jml_potongan   = $this->input->post('jml_potongan');

			$data = array(
				'potongan'          => $potongan,
				'jml_potongan'      => $jml_potongan,
			);

			$this->penggajianModel->insert_data($data, 'potongan_gaji');
			$this->session->set_flashdata('success', 
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil di tambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  		<span aria-hidden="true">&times;</span>
				</button>
		  	</div>');
			redirect('admin/potonganGaji');
		}
	}

    public function updateDataAksi() 
	{
		$this->_rules();
		
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$id					= $this->input->post('id');
			$potongan 		    = $this->input->post('potongan');
			$jml_potongan 		= $this->input->post('jml_potongan');

			$data = array(
				'potongan' 	    => $potongan,
				'jml_potongan' 	=> $jml_potongan,
			);

			$where = array (
				'id' => $id
			);

			$this->penggajianModel->update_data('potongan_gaji', $data, $where);
			$this->session->set_flashdata('success', 
			'<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil di update!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  		<span aria-hidden="true">&times;</span>
				</button>
		  	</div>');
			redirect('admin/potonganGaji');
		}
	}

    public function _rules() {
		$this->form_validation->set_rules('potongan', 'Jenis Potongan', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));
		$this->form_validation->set_rules('jml_potongan', 'Jumlah Potongan', 'required',
		array('required' => '%s Harus di isi terlebih dahulu'));

		$this->session->set_flashdata('error', 
			'<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data gagal di tambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  		<span aria-hidden="true">&times;</span>
				</button>
		  	</div>');
	}

    public function deleteData($id) {
		$where = array('id' => $id);

		$this->penggajianModel->delete_data($where, 'potongan_gaji');
		$this->session->set_flashdata('success',
		'<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil di hapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  		<span aria-hidden="true">&times;</span>
			</button>
  		</div>');
		redirect('admin/potonganGaji');
	}
}