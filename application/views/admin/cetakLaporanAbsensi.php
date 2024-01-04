<!DOCTYPE html>
<html>
<head>
	<title><?= $title?></title>
	<style type="text/css">
		body{
			font-family: Arial;
			color: black;
		}
	</style>
</head>
<body>
	<center>
		<h1>PT. CUMAN OMONG DOANG(COD)</h1>
		<h2>Laporan Absensi Karyawan</h2>
	</center>

	<?php
	// if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
	// 	$bulan = $_GET['bulan'];
	// 	$tahun = $_GET['tahun'];
	// 	$bulantahun = $bulan . $tahun;
	// } else {
	// 	$bulan = date('m');
	// 	$tahun = date('Y');
	// 	$bulantahun = $bulan . $tahun;
	// }
	
	$bulan = $this->input->post('bulan');
	$tahun = $this->input->post('tahun');
    ?>
	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo $bulan ?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><?= $tahun ?></td>
		</tr>
	</table>

	<table class="table table-bordered table-triped">
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">NIK</th>
				<th class="text-center">Nama Pegawai</th>
				<th class="text-center">Jabatan</th>
				<th class="text-center">Hadir</th>
				<th class="text-center">Sakit</th>
				<th class="text-center">Alpha</th>
			</tr>
			<?php $no=1; foreach($lap_kehadiran as $l) : ?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td class="text-center"><?= $l->nik ?></td>
				<td class="text-center"><?= $l->nama_karyawan ?></td>
				<td class="text-center"><?= $l->nama_jabatan ?></td>
				<td class="text-center"><?= $l->hadir ?></td>
				<td class="text-center"><?= $l->sakit ?></td>
				<td class="text-center"><?= $l->alpha ?></td>
			</tr>
			<?php endforeach ;?>
		</table>

</body>
</html>

<script type="text/javascript">
	window.print();
</script>