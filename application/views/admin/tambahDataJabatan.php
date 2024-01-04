<?php echo $this->session->flashdata('error') ?>
<div class="container-fluid">
                    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

        <div class="card" style="width: 60%;">
            <div class="card-body">
                <form role="form" action="<?= base_url('admin/dataJabatan/tambahDataAksi') ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" class="form-control" placeholder="Masukkan Nama Jabatan">
                            <?= form_error('nama_jabatan','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Gaji Pokok</label>
                            <input type="text" name="gaji_pokok" class="form-control" placeholder="Masukkan Gaji Pokok">
                            <?= form_error('gaji_pokok','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Tunjangan Transport</label>
                            <input type="text" name="tj_transport" class="form-control" placeholder="Masukkan Tunjangan Transport">
                            <?= form_error('tj_transport','<div class="text-small text-danger">','</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Uang Makan</label>
                            <input type="text" name="uang_makan" class="form-control" placeholder="Masukkan Uang Makan">
                            <?= form_error('uang_makan','<div class="text-small text-danger">','</div>') ?>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Reset</button>

                </form>
            </div>
        </div>
                    
    </div>

</div>


<!-- modal bootstrap -->
