<?php echo $this->session->flashdata('error') ?>
<div class="container-fluid">
                    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

        <div class="card" style="width: 60%; margin-bottom: 30px;">
            <div class="card-body">
                <form role="form" action="<?= base_url('admin/dataKaryawan/tambahDataAksi') ?>" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>NIK </label>
                            <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK">
                            <?= form_error('nik','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" class="form-control" placeholder="Masukkan Nama Karyawan">
                            <?= form_error('nama_karyawan','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                            <?= form_error('username','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                            <?= form_error('password','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="" class="form-control">
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <?= form_error('jenis_kelamin','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="jabatan" id="" class="form-control">
                                <option value="">--Pilih Jabatan--</option>
                                <?php foreach($jabatan as $j) : ?>
                                <option value="<?= $j->nama_jabatan ?>">
                                <?= $j->nama_jabatan ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('jabatan','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control">
                            <?= form_error('tanggal_masuk','<div class="text-small text-danger">','</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="">--Pilih Status--</option>
                                <option value="Karyawan Tetap">Karyawan Tetap</option>
                                <option value="Karyawan Tidak Tetap">Karyawan Tidak Tetap</option>
                            </select>
                            <?= form_error('status','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Hak Akses</label>
                            <select name="hak_akses" id="" class="form-control">
                                <option value="">--Pilih Hak Akses--</option>
                                <option value="1">Admin</option>
                                <option value="2">Karyawan</option>
                            </select>
                            <?= form_error('hak_akses','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Reset</button>

                </form>
            </div>
        </div>
                    
    </div>

</div>