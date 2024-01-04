<div class="container-fluid">
                    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">Bulan/Tahun</th>
                    <th class="text-center">Gaji Pokok</th>
                    <th class="text-center">Tj. Transport</th>
                    <th class="text-center">Uang Makan</th>
                    <th class="text-center">Lembur</th>
                    <th class="text-center">THR</th>
                    <th class="text-center">Bonus</th>
                    <th class="text-center">Potongan</th>
                    <th class="text-center">Total Gaji</th>
                    <th class="text-center">Cetak Slip</th>
                </tr>
                <?php foreach ($gaji as $g) : ?>
                    <?php
                    $alpha = $this->penggajianModel->potonganByKategori('alpha');
                    $sakit = $this->penggajianModel->potonganByKategori('sakit');

                    $potongan_alpha = $g->alpha * $alpha;
                    $potongan_sakit = $g->sakit * $sakit;

                    $total_potongan = $potongan_alpha + $potongan_sakit;
                    ?>
                    <tr>
                        <td class="text-center"><?= $g->bulan ?></td>
                        <td class="text-center">Rp. <?= number_format($g->gaji_pokok, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->tj_transport, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->uang_makan, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->lembur, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->thr, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->bonus, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($total_potongan, 0, ',', '.')  ?></td>
                        <td class="text-center">Rp. <?= number_format($g->gaji_pokok + $g->tj_transport + $g->uang_makan+$g->lembur+$g->thr+$g->bonus - $total_potongan, 0, ',', '.')  ?></td>
                        <td>
  			                <center>
  			                	<a class="btn btn-sm btn-primary" href="<?= base_url('karyawan/dataGaji/cetakSlip/'.$g->id_kehadiran)?>"><i class="fas fa-print"></i></a>
  			                </center>
  		                </td>
                    </tr>
                <?php endforeach; ?>
            </table>
    </div>    
    
    </div>

</div>