<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataPenggajian extends CI_Controller {

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
        $data['title'] = 'Data Gaji Karyawan';
		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}
		$data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
		$data['gaji'] = $this->db->query("SELECT data_karyawan.nik,
		data_karyawan.nama_karyawan,data_karyawan.jenis_kelamin,
		data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.lembur,data_jabatan.thr,data_jabatan.bonus,
		data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha,data_kehadiran.sakit
		FROM data_karyawan
		INNER JOIN data_kehadiran ON data_kehadiran.nik=data_karyawan.nik
		INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
		WHERE data_kehadiran.bulan='$bulantahun'
		ORDER BY data_karyawan.nama_karyawan ASC")->result();

        $this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataGaji', $data);
		$this->load->view('templates_admin/footer');
	}

	public function cetakGaji() {
		$data['title'] = 'Cetak Gaji Karyawan';
		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}
		$data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
		$data['cetakGaji'] = $this->db->query("SELECT data_karyawan.nik,
		data_karyawan.nama_karyawan,data_karyawan.jenis_kelamin,
		data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.lembur,data_jabatan.thr,data_jabatan.bonus,
		data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha,data_kehadiran.sakit
		FROM data_karyawan
		INNER JOIN data_kehadiran ON data_kehadiran.nik=data_karyawan.nik
		INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
		WHERE data_kehadiran.bulan='$bulantahun'
		ORDER BY data_karyawan.nama_karyawan ASC")->result();

        $this->load->view('templates_admin/header', $data);
		$this->load->view('admin/cetakDataGaji', $data);
	}
}