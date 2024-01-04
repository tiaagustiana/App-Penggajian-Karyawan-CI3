<div class="container-fluid">
                    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="alert alert-success font-weight-bold mb-4" style="width: 65%">Selamat datang, Anda login sebagai pegawai</div>

<div class="card" style="margin-bottom: 120px; width: 65%">
    <div class="card-header font-weight-bold bg-primary text-white">
        Data Pegawai
    </div>

<?php foreach($karyawan as $k) : ?>
<div class="card-body">
    <div class="row">
        <div>
            <img style="width: 250px" src="<?=base_url('assets/photo/'). $this->session->userdata('photo') ?>">
        </div>
        <div>
            <table class="table">
                <tr>
                    <td>Nama Pegawai</td>
                    <td>:</td>
                    <td><?= $k->nama_karyawan?></td>
                </tr>

                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?= $k->jabatan?></td>
                </tr>

                <tr>
                    <td>Tanggal Masuk</td>
                    <td>:</td>
                    <td><?= $k->tanggal_masuk?></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td><?= $k->status?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php endforeach; ?>
                    
    </div>

</div>