<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title?></title>
	<style type="text/css">
		body{
			font-family: Arial, sans-serif;
			color: black;
            font-weight: bold;
		}
		@media print {
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                size: A4; /* Atur ukuran kertas */
            }
		}
	</style>
</head>
<body>
	<center>
		<h2 style="margin-top: 50px;"><strong>SLIP GAJI</strong></h2>
		<hr style="width: 80%; border-width: 5px; color: black">
	</center>

	<?php foreach($potongan as $p) {
	$potongan=$p->jml_potongan;
	} ?>
    
    <?php foreach ($print_slip as $ps) : ?>
        <?php
            $alpha = $this->penggajianModel->potonganByKategori('alpha');
            $sakit = $this->penggajianModel->potonganByKategori('sakit');

        $potongan_alpha = $ps->alpha * $alpha;
        $potongan_sakit = $ps->sakit * $sakit;

        $total_potongan = $potongan_alpha + $potongan_sakit;
    ?>
	<div class="row">
		<div class="col" style="margin-left: 300px;">
		<img src="<?= base_url('assets/img/logo_cod.png') ?>" alt="logo" width="240px">
			<p style="margin-top: 20px;"><strong>COD TOWER</strong> Lantai 7 Zona A6 </br>
				Jl. Karangnunggal A17 No. 5 </br>
				Tasikmalaya, Jawa Barat
			</p>
		</div>
		<div class="col">
			<div>
			<table style="width: 100%; margin-top: 50px;">			
		<tr>
			<td>Periode(Bulan/Tahun)</td>
			<td>:</td>
			<td><?= ($ps->bulan) ?></td>
		</tr>
		<tr>
			<td width="20%">Karyawan</td>
			<td width="2%">:</td>
			<td><?= $ps->nama_karyawan?></td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td>:</td>
			<td><?= $ps->nama_jabatan?></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>:</td>
			<td><?= $ps->status ?></td>
		</tr>
		<tr>
			<td>NIK</td>
			<td>:</td>
			<td><?= $ps->nik?></td>
		</tr>
		<tr>
			<td>PTKP</td>
			<td>:</td>
			<td>TK/0</td>
		</tr>
		<!-- <tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?= substr($ps->bulan, 0,2) ?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><?= substr($ps->bulan, 2,4) ?></td>
		</tr> -->
	</table>
			</div>		
		</div>
	</div>
	<hr style="width: 80%; border-width: 5px; color: black">
	
	<?php
	$tunjangan_makan = $ps->uang_makan * $ps->hadir;
	?>
	<div class="row">
		<div class="col" style="margin-left: 170px;">
		<p><strong>PENERIMAAN</strong></p>
		<p>- Gaji Pokok</p>
		<p>- Tunjangan Makan ( <?= $ps->hadir ?> x <?= number_format($ps->uang_makan,0,',','.') ?> )</p>
		<p>- Tunjangan Transport</p>
		<p>- Lembur</p>
		<p>- THR</p>
		<p>- Bonus</p>
		<hr style="width: 250%; padding-left: 50%; border-width: 3px; color: black">
		<p><strong>Total Penghasilan Bruto</strong></p>
		<hr style="width: 250%; padding-left: 50%; border-width: 3px; color: black">
		</br>
		<p><strong>PENGURANGAN</strong></p>
		<p>- Potongan (Alpha(<?= $ps->alpha ?>), Sakit(<?= $ps->sakit ?>))</p>
		</br>
		<hr style="width: 250%; padding-left: 50%; border-width: 3px; color: black">
		<p class="mt-2"><strong>TOTAL DITERIMA KARYAWAN</strong></p>
		<hr style="width: 250%; padding-left: 50%; border-width: 3px; color: black">
		</div>
		<div class="col" style="margin-left: 600px;">
		<p></p>
		</br>
		<p><?= number_format($ps->gaji_pokok,0,',','.') ?></p>
		<p><?= number_format($tunjangan_makan,0,',','.') ?></p>
		<p><?= number_format($ps->tj_transport,0,',','.') ?></p>
		<p><?= number_format($ps->lembur,0,',','.') ?></p>
		<p><?= number_format($ps->thr,0,',','.') ?></p>
		<p><?= number_format($ps->bonus,0,',','.') ?></p>
		</br>

		<p><strong><?= number_format($ps->gaji_pokok + $ps->tj_transport + $tunjangan_makan,0,',','.') ?></strong></p>
		</br>
		</br>
		</br>
		<p><?= number_format($total_potongan,0,',','.') ?></p>
		</br>
		</br>
		</br>
		<p><strong><?= number_format($ps->gaji_pokok+$ps->tj_transport+$tunjangan_makan-$total_potongan,0,',','.') ?></strong></p>
		</div>
	</div>
	<hr style="width: 80%; border-width: 5px; color: black">
		<center class="mt-5 mb-4">
			<p>Jakarta, <?= date("d M Y")?></p>
		</center>
	</br>
	</br>
	</br>
		
	<div class="row mt-4">
		<div class="col" style="margin-left: 190px;">
		<p>Penerima</p>
				<br>
				<br>
				<p class="font-weight-bold"><?= $ps->nama_karyawan?></p>
		</div>
		<div class="col" style="margin-left: 500px;">
			<p>PT CUMAN OMONG DOANG (COD)</p>
				<br>
				<br>
				<p>___________________</p>
		</div>
	</div>
		<!-- <table width="100%">
		<tr>
			<td></td>
			<td>
				<p>Pegawai</p>
				<br>
				<br>
				<p class="font-weight-bold"><?= $ps->nama_karyawan?></p>
			</td>

			<td width="200px">
				<p>Jakarta, <?= date("d M Y")?> <br> Finance,</p>
				<br>
				<br>
				<p>___________________</p>
			</td>
		</tr>
	</table> -->
	

	<?php endforeach ;?>

</body>
</html>

<script type="text/javascript">
	window.print();
</script>