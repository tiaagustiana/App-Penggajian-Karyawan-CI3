<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Input Absensi Karyawan
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



                <button type="submit" class="btn ml-auto btn-primary mb-2"><i class="fas fa-eye"></i> Generate Form</button>
                
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

    
    <form method="POST">
        <button class="btn btn-success mb-3" type="submit" name="submit" value="submit"> Simpan</button>
    <table class="table table-bordered table-striped">

        <tr class="text-secondary">
            <th class="text-center">No</th>
            <th class="text-center">NIK</th>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Nama Jabatan</th>
            <th class="text-center" width="8%">Hadir</th>
            <th class="text-center" width="8%">Sakit</th>
            <th class="text-center" width="8%">Alpha</th>
            <th class="text-center" width="8%">Izin</th>
            <th class="text-center">Keterlambatan</th>
        </tr>
            <?php $no = 1; foreach($input_absensi as $a) : ?>
            <tr class="text-secondary">
                <input type="hidden" name="bulan[]" class="form-control" value="<?= $bulantahun ?>">
                <input type="hidden" name="nik[]" class="form-control" value="<?= $a->nik ?>">
                <input type="hidden" name="nama_karyawan[]" class="form-control" value="<?= $a->nama_karyawan ?>">
                <input type="hidden" name="jenis_kelamin[]" class="form-control" value="<?= $a->jenis_kelamin ?>">
                <input type="hidden" name="nama_jabatan[]" class="form-control" value="<?= $a->nama_jabatan ?>">

                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $a->nik ?></td>
                <td class="text-center"><?= $a->nama_karyawan ?></td>
                <td class="text-center"><?= $a->jenis_kelamin ?></td>
                <td class="text-center"><?= $a->nama_jabatan ?></td>
                <td><input type="number" name="hadir[]" class="form-control" value="0"></td>
                <td><input type="number" name="sakit[]" class="form-control" value="0"></td>
                <td><input type="number" name="alpha[]" class="form-control" value="0"></td>
                <td><input type="number" name="izin[]" class="form-control" value="0"></td>
                <td><input type="number" name="keterlambatan[]" class="form-control" value="0"></td>
            </tr>
            <?php endforeach; ?>

    </table>
    <br><br>
    </form>
</div>

</div>