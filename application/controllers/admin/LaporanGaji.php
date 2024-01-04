<?php

class LaporanGaji extends CI_Controller {

	public function index() 
	{	
		$data['title'] = "Laporan Gaji Karyawan";

		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/filterLaporanGaji');
		$this->load->view('templates_admin/footer');
	}

    public function cetakLaporanGaji() {
        $data['title'] = 'Cetak Laporan Gaji Karyawan';
		// if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
		// 	$bulan = $_GET['bulan'];
		// 	$tahun = $_GET['tahun'];
		// 	$bulantahun = $bulan.$tahun;
		// } else {
		// 	$bulan = date('m');
		// 	$tahun = date('Y');
		// 	$bulantahun = $bulan.$tahun;
		// }
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$bulantahun = $bulan.$tahun;
		$data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
		$data['cetakGaji'] = $this->db->query("SELECT data_karyawan.nik,
		data_karyawan.nama_karyawan,data_karyawan.jenis_kelamin,
		data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,
		data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha,data_kehadiran.sakit,
		data_jabatan.lembur,data_jabatan.thr,data_jabatan.bonus
		FROM data_karyawan
		INNER JOIN data_kehadiran ON data_kehadiran.nik=data_karyawan.nik
		INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
		WHERE data_kehadiran.bulan='$bulantahun'
		ORDER BY data_karyawan.nama_karyawan ASC")->result();

        $this->load->view('templates_admin/header', $data);
		$this->load->view('admin/cetakDataGaji', $data);
    }
}

?>