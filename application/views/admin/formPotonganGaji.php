<div class="container-fluid">
                    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card" style="width: 60%; margin-bottom: 30px;">
            <div class="card-body">
                <form role="form" action="<?= base_url('admin/potonganGaji/tambahDataAksi') ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Jenis Potongan</label>
                            <input type="text" name="potongan" class="form-control">
                            <?= form_error('potongan','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Potongan</label>
                            <input type="number" name="jml_potongan" class="form-control">
                            <?= form_error('jml_potongan','<div class="text-small text-danger">', '</div>') ?>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>

                </form>
            </div>
        </div>
                    
    </div>

</div>