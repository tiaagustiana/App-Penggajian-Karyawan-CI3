<div class="container-fluid">
                    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

                <a class="btn btn-sm btn-primary mb-3" href="<?= base_url('admin/dataKaryawan/tambahData') ?>">
                    <i class="fas fa-plus"></i>
                    Tambah Data
                </a>
                    <table class="table table-bordered table-striped">
                        
                    <tr class="text-secondary">
                        <th class="text-center">No</th>
                        <th class="text-center">NIK</th>
                        <th class="text-center">Nama Karyawan</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Tanggal Masuk</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Photo</th>
                        <th class="text-center">Hak Akses</th>
                        <th class="text-center">Action</th>
                    </tr>
            
                    <?php $no=1; foreach($karyawan as $k) : ?>
                    <tr class="text-secondary">
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $k->nik ?></td>
                        <td class="text-center"><?= $k->nama_karyawan ?></td>
                        <td class="text-center"><?= $k->jenis_kelamin ?></td>
                        <td class="text-center"><?= $k->jabatan ?></td>
                        <td class="text-center"><?= $k->tanggal_masuk ?></td>
                        <td class="text-center"><?= $k->status ?></td>
                        <td class="text-center"><img src="<?= base_url(). 'assets/photo/'. $k->photo ?>" width="30px"></td>
                        <?php if($k->hak_akses=='1') { ?>
                            <td>Admin</td>
                        <?php } else { ?>
                            <td>Karyawan</td>
                        <?php } ?>
                        <td class="text-center">
                            <!-- <a class="btn btn-sm btn-warning" href="<?= base_url('admin/dataKaryawan/updateData/'.$k->id_karyawan) ?>">
                                    <i class="fas fa-edit"></i>
                            </a> -->
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $k->id_karyawan?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a class="btn btn-sm btn-danger" href="<?= base_url('admin/dataKaryawan/deleteData/' .$k->id_karyawan) ?>" 
                                onclick=" return confirm('yakin hapus <?= $k->nama_karyawan ?> ? ')" href="<?= base_url('admin/dataKaryawan/deleteData/'.$k->id_karyawan) ?>">
                                    <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                        
                      </table>
                    
    </div>

</div>

<!-- modal bootstrap -->
<?php foreach($karyawan as $k) : ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $k->id_karyawan ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog"></div>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      <form role="form" action="<?= base_url('admin/dataKaryawan/updateDataAksi') ?>" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>NIK </label>
                            <input type="hidden" name="id_karyawan" class="form-control" value="<?= $k->id_karyawan ?>">
                            <input type="text" name="nik" class="form-control" value="<?= $k->nik ?>">
                            <?= form_error('nik','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" class="form-control" value="<?= $k->nama_karyawan ?>">
                            <?= form_error('nama_karyawan','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?= $k->username ?>">
                            <?= form_error('username','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?= $k->password ?>">
                            <?= form_error('password','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="" class="form-control">
                                <option value="<?= $k->jenis_kelamin ?>"><?= $k->jenis_kelamin ?></option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <?= form_error('jenis_kelamin','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="jabatan" id="" class="form-control">
                                <option value="<?= $k->jabatan ?>"><?= $k->jabatan ?></option>
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
                            <input type="date" name="tanggal_masuk" class="form-control" value="<?= $k->tanggal_masuk ?>">
                            <?= form_error('tanggal_masuk','<div class="text-small text-danger">','</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="<?= $k->status ?>"><?= $k->status ?></option>
                                <option value="Karyawan Tetap">Karyawan Tetap</option>
                                <option value="Karyawan Tidak Tetap">Karyawan Tidak Tetap</option>
                            </select>
                            <?= form_error('status','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <input type="hidden" name="photo_old" value="<?= $k->photo ; ?>">
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Hak Akses</label>
                            <select name="hak_akses" id="" class="form-control">
                                <option value="">
                                    <?php if($k->hak_akses=='1') { ?>
                                        <td>Admin</td>
                                    <?php } else { ?>
                                        <td>Karyawan</td>
                                    <?php } ?>
                                </option>
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
<?php endforeach ; ?>