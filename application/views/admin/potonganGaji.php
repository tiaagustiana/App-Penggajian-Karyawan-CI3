<div class="container-fluid">
                    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

        <?php echo $this->session->flashdata('success') ?>
        
        <a href="<?= base_url('admin/potonganGaji/tambahData') ?>" class="btn btn-success btn-sm mb-3 mt-2">
        <i class="fas fa-plus"></i> Tambah Data</a>

        <table class="table table-bordered table-striped">                        
                    <tr class="text-secondary">
                        <th class="text-center">No</th>
                        <th class="text-center">Jenis Potongan</th>
                        <th class="text-center">Jumlah Potongan</th>
                        <th class="text-center">Action</th>
                    </tr>
            
                    <?php $no=1; foreach($pot_gaji as $p) :?>
                    <tr class="text-secondary">
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $p->potongan ?></td>
                        <td class="text-center">Rp. <?= number_format($p->jml_potongan,0,',','.') ?></td>
                        <td class="text-center">
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $p->id?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a class="btn btn-sm btn-danger" href="<?= base_url('admin/potonganGaji/deleteData/' .$p->id) ?>" 
                                onclick=" return confirm('yakin hapus?')" href="<?= base_url('admin/potonganGaji/deleteData/'.$p->id) ?>">
                                    <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ;?>
        </table>

    </div>

</div>

<!-- modal bootstrap -->
<?php foreach($pot_gaji as $p) : ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $p->id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Potongan Gaji</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
                <form role="form" action="<?= base_url('admin/potonganGaji/updateDataAksi/'. $p->id) ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Jenis Potongan</label>
                            <input type="hidden" name="id" value="<?= $p->id?>">
                            <input type="text" name="potongan" class="form-control" value="<?= $p->potongan ?>">
                            <?= form_error('potongan','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Potongan</label>
                            <input type="number" name="jml_potongan" class="form-control" value="<?= $p->jml_potongan ?>">
                            <?= form_error('jml_potongan','<div class="text-small text-danger">', '</div>') ?>
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