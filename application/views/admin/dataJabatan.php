<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>
                <a class="btn btn-sm btn-primary mb-3" href="<?= base_url('admin/dataJabatan/tambahData') ?>">
                    <i class="fas fa-plus"></i>
                    Tambah Data
                </a>
                    <table class="table table-bordered table-striped">
                        
                    <tr class="text-secondary">
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Jabatan</th>
                        <th class="text-center">Gaji Pokok</th>
                        <th class="text-center">Tj. Transport</th>
                        <th class="text-center">Uang Makan/Hari</th>
                        <th class="text-center">Lembur</th>
                        <th class="text-center">THR</th>
                        <th class="text-center">Bonus</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Action</th>
                    </tr>

                    <?php $no=1; foreach ($jabatan as $j): ?>
            
                    <tr class="text-secondary">
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $j->nama_jabatan ?></td>
                        <td class="text-center">Rp.<?= number_format($j->gaji_pokok,0,',','.') ?></td>
                        <td class="text-center">Rp.<?= number_format($j->tj_transport,0,',','.') ?></td>
                        <td class="text-center">Rp.<?= number_format($j->uang_makan,0,',','.') ?></td>
                        <td class="text-center">Rp.<?= number_format($j->lembur,0,',','.') ?></td>
                        <td class="text-center">Rp.<?= number_format($j->thr,0,',','.') ?></td>
                        <td class="text-center">Rp.<?= number_format($j->bonus,0,',','.') ?></td>
                        <td class="text-center">Rp.<?= number_format($j->gaji_pokok  + $j->tj_transport + $j->uang_makan ,0,',','.') ?></td>
                        <td class="text-center">
                                <!-- <a class="btn btn-sm btn-warning" href="<?= base_url('admin/dataJabatan/updateData/'.$j->id_jabatan) ?>">
                                    <i class="fas fa-edit"></i>
                                </a> -->
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $j->id_jabatan?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a class="btn btn-sm btn-danger" onclick=" return confirm('yakin hapus <?= $j->nama_jabatan ?> ? ')" href="<?= base_url('admin/dataJabatan/deleteData/'.$j->id_jabatan) ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                        
                      </table>

</div>
</div>

<!-- modal bootstrap -->
<?php foreach($jabatan as $j) : ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $j->id_jabatan ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
                <form role="form" action="<?= base_url('admin/dataJabatan/updateDataAksi/'. $j->id_jabatan) ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Jabatan</label>
                            <input type="hidden" name="id_jabatan" value="<?= $j->id_jabatan ?>">
                            <input type="text" name="nama_jabatan" class="form-control" value="<?= $j->nama_jabatan ?>">
                            <?= form_error('nama_jabatan','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Gaji Pokok</label>
                            <input type="number" name="gaji_pokok" class="form-control" value="<?= $j->gaji_pokok ?>">
                            <?= form_error('gaji_pokok','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Tunjangan Transport</label>
                            <input type="number" name="tj_transport" class="form-control" value="<?= $j->tj_transport ?>">
                            <?= form_error('tj_transport','<div class="text-small text-danger">','</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Uang Makan</label>
                            <input type="number" name="uang_makan" class="form-control" value="<?= $j->uang_makan ?>">
                            <?= form_error('uang_makan','<div class="text-small text-danger">','</div>') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                    </div>
                </form>
      </div>
      
    </div>
  </div>
</div>
<?php endforeach ; ?>
