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
		<h1>PT. Cuman Omong Doang(COD)</h1>
		<h2>Daftar Gaji Karyawan</h2>
	</center>

	<?php
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan.$tahun;
    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan.$tahun;
    }
    // $bulan = $this->input->post('bulan');
	// $tahun = $this->input->post('tahun');
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
			<td><?php echo $tahun ?></td>
		</tr>
	</table>
	<table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Nama Karyawan</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Gaji Pokok</th>
                    <th class="text-center">Tj. Transport</th>
                    <th class="text-center">Uang Makan</th>
                    <th class="text-center">Lembur</th>
                    <th class="text-center">THR</th>
                    <th class="text-center">Bonus</th>
                    <th class="text-center">Potongan</th>
                    <th class="text-center">Total Gaji</th>
                </tr>
                <?php $no = 1; foreach ($cetakGaji as $g) : ?>
                    <?php
                    $alpha = $this->penggajianModel->potonganByKategori('alpha');
                    $sakit = $this->penggajianModel->potonganByKategori('sakit');

                    $potongan_alpha = $g->alpha * $alpha;
                    $potongan_sakit = $g->sakit * $sakit;

                    $total_potongan = $potongan_alpha + $potongan_sakit;
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $g->nik ?></td>
                        <td class="text-center"><?= $g->nama_karyawan ?></td>
                        <td class="text-center"><?= $g->jenis_kelamin ?></td>
                        <td class="text-center"><?= $g->nama_jabatan ?></td>
                        <td class="text-center">Rp. <?= number_format($g->gaji_pokok, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->tj_transport, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->uang_makan, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->lembur, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->thr, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->bonus, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($total_potongan, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->gaji_pokok + $g->tj_transport + $g->uang_makan - $total_potongan, 0, ',', '.')  ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

		<table width="100%">
			<tr>
				<td></td>
				<td width="200px">
					<p>Jakarta, <?php echo date("d M Y") ?> <br> Finance</p>
					<br>
					<br>
					<p>_____________________</p>
				</td>
			</tr>
		</table>
</body>
</html>

<script type="text/javascript">
	window.print();
</script>