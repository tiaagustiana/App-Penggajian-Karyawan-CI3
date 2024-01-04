<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Absensi Karyawan
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



                <button type="submit" class="btn ml-auto btn-primary mb-2"><i class="fas fa-eye"></i> Tampilkan Data</button>
                <a href="<?= base_url('admin/dataAbsensi/inputAbsensi') ?>" class="btn btn-success mb-2 ml-2"><i class="fas fa-plus"></i> Input Kehadiran</a>
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
        Menampilkan Data Kehadiran Karyawan Bulan: <strong><?php echo $bulan ?></strong> ,Tahun: <strong><?php echo $tahun ?></strong>
    </div>

    <?php
    $jumlah_data = count($absensi);
    if($jumlah_data > 0) { ?>

    <table class="table table-bordered table-striped">

        <tr class="text-secondary">
            <th class="text-center">No</th>
            <th class="text-center">NIK</th>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Nama Jabatan</th>
            <th class="text-center">Hadir</th>
            <th class="text-center">Sakit</th>
            <th class="text-center">Alpha</th>
            <th class="text-center">Izin</th>
            <th class="text-center">Keterlambatan</th>
        </tr>
            <?php $no = 1; foreach($absensi as $a) : ?>
            <tr class="text-secondary">
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $a->nik ?></td>
                <td class="text-center"><?= $a->nama_karyawan ?></td>
                <td class="text-center"><?= $a->jenis_kelamin ?></td>
                <td class="text-center"><?= $a->nama_jabatan ?></td>
                <td class="text-center"><?= $a->hadir ?></td>
                <td class="text-center"><?= $a->sakit ?></td>
                <td class="text-center"><?= $a->alpha ?></td>
                <td class="text-center"><?= $a->izin ?></td>
                <td class="text-center"><?= $a->keterlambatan ?></td>
            </tr>
            <?php endforeach; ?>

    </table>

    <?php }else{?>
        <span class="badge badge-danger">
            <i class="fas fa-info-circle"></i>
            Data masih kosong, silahkan input terlebih dahulu data kehadiran pada bulan dan tahun yang Anda pilih!
        </span>
    <?php  }?>
</div>

</div>