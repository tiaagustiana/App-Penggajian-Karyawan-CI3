<?php

class SlipGaji extends CI_Controller {
	public function index() 
	{
		$data['title'] = "Slip Gaji Karyawan";
		$data['karyawan'] = $this->penggajianModel->get_data('data_karyawan')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/filterSlipGaji', $data);
		$this->load->view('templates_admin/footer');
	}

    public function cetakSlipGaji(){

        $data['title'] = "Cetak Slip Gaji";
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')-> result();
        $nama = $this->input->post('nama_karyawan');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bulantahun =$bulan.$tahun;
    
        $data['print_slip'] = $this->db->query("SELECT data_karyawan.nik,data_karyawan.nama_karyawan,data_karyawan.status,
        data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.tj_transport,data_jabatan.uang_makan,data_jabatan.lembur,data_jabatan.thr,data_jabatan.bonus,
        data_kehadiran.hadir,data_kehadiran.alpha,data_kehadiran.sakit,data_kehadiran.bulan 
        FROM data_karyawan INNER JOIN data_kehadiran ON data_kehadiran.nik=data_karyawan.nik
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
        WHERE data_kehadiran.bulan='$bulantahun' AND data_kehadiran.nama_karyawan='$nama'")->result();
        $this->load->view('templates_admin/header',$data);
        $this->load->view('admin/cetakSlipGaji', $data);
        }
}
?>