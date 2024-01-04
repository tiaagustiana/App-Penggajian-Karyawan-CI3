<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Gaji Karyawan
        </div>
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="staticEmail2">Bulan:</label>
                    <select class="form-control ml-3" name="bulan">
                        <option value="">--Pilih Bulan--</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <div class="form-group mb-2 ml-5">
                    <label for="staticEmail2">Tahun:</label>
                    <select class="form-control ml-3" name="tahun">
                        <option value="">--Pilih Tahun--</option>
                        <?php $tahun = date('Y');
                        for ($i = 2023; $i < $tahun + 5; $i++) { ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                </div>

                <?php
                if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                    $bulan = $_GET['bulan'];
                    $tahun = $_GET['tahun'];
                    $bulantahun = $bulan . $tahun;
                } else {
                    $bulan = date('m');
                    $tahun = date('Y');
                    $bulantahun = $bulan . $tahun;
                }
                ?>

                <button type="submit" class="btn ml-auto btn-primary mb-2"><i class="fas fa-eye"></i> Tampilkan Data</button>
                <?php if (count($gaji) > 0) { ?>
                    <a href="<?= base_url('admin/dataPenggajian/cetakGaji?bulan=' . $bulan), '&tahun=' . $tahun ?>" class="btn btn-success mb-2 ml-2"><i class="fas fa-plus"></i> Cetak Daftar Gaji</a>
                <?php } else { ?>
                    <button type="button" class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#exampleModal">
                        Cetak Daftar Gaji
                    </button>
                <?php } ?>
            </form>
        </div>
    </div>

    <?php
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan . $tahun;
    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan . $tahun;
    }
    ?>

    <div class="alert alert-success" role="alert">
        Menampilkan Data Gaji Karyawan Bulan: <strong><?php echo $bulan ?></strong> ,Tahun: <strong><?php echo $tahun ?></strong>
    </div>

    <div class="table-responsive">
        <?php
        $jumlah_data = count($gaji);
        if ($jumlah_data > 0) { ?>
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
                <?php $no = 1; foreach ($gaji as $g) : ?>
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
        <?php } else { ?>
            <span class="badge badge-danger">
                <i class="fas fa-info-circle"></i>
                Data masih kosong, silahkan input terlebih dahulu data kehadiran pada bulan dan tahun yang Anda pilih!
            </span>
        <?php  } ?>
    </div>

</div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Data gaji masih kosong, silahkan input absensi terlebih dahulu pada bulan dan tahun yang anda pilih.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>