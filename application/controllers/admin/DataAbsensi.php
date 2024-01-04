<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataAbsensi extends CI_Controller {

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
        $data['title'] = 'Data Absensi Karyawan';
		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }
		$data['absensi'] = $this->db->query("SELECT data_kehadiran.*, data_karyawan.nama_karyawan, data_karyawan.jenis_kelamin, 
		data_karyawan.jabatan FROM data_kehadiran 
		INNER JOIN data_karyawan ON data_kehadiran.nik = data_karyawan.nik
		INNER JOIN data_jabatan ON data_karyawan.jabatan = data_jabatan.nama_jabatan
		WHERE data_kehadiran.bulan = '$bulantahun'
		ORDER BY data_karyawan.nama_karyawan ASC")->result();

        $this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataAbsensi', $data);
		$this->load->view('templates_admin/footer');
	}

	public function inputAbsensi() {
		if($this->input->post('submit', TRUE) == 'submit') {
			$post = $this->input->post();
			foreach ($post['bulan'] as $key => $value) {
				if($post['bulan'][$key] !='' || $post['nik'][$key] !='')
				{
					$simpan[] = array(
						'bulan'				=> $post['bulan'][$key],
						'nik'				=> $post['nik'][$key],
						'nama_karyawan'		=> $post['nama_karyawan'][$key],
						'jenis_kelamin'		=> $post['jenis_kelamin'][$key],
						'nama_jabatan'		=> $post['nama_jabatan'][$key],
						'hadir'				=> $post['hadir'][$key],
						'sakit'				=> $post['sakit'][$key],
						'alpha'				=> $post['alpha'][$key],
						'izin'				=> $post['izin'][$key],
						'keterlambatan'		=> $post['keterlambatan'][$key],
					);
				}
			}
			$this->penggajianModel->insert_batch('data_kehadiran', $simpan);
			$_SESSION['tambah'] = "Data berhasil di tambah";
			redirect('admin/dataAbsensi');
		}


		$data['title'] = 'Form Input Absensi';
		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }
		$data['input_absensi'] = $this->db->query("SELECT data_karyawan.*, data_jabatan.nama_jabatan 
		FROM data_karyawan
		INNER JOIN data_jabatan ON data_karyawan.jabatan=data_jabatan.nama_jabatan
		WHERE NOT EXISTS (SELECT * FROM data_kehadiran WHERE bulan='$bulantahun' 
		AND data_karyawan.nik= data_kehadiran.nik)
		ORDER BY data_karyawan.nama_karyawan ASC")->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formInputAbsensi', $data);
		$this->load->view('templates_admin/footer');
	}
}