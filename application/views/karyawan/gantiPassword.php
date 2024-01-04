<div class="container-fluid">
                    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card" style="width: 40%">
  	<div class="card-body">
  		<form method="POST" action="<?= base_url('karyawan/gantiPassword/gantiPasswordAksi')?>">
  			
  			<div class="form-grup">
  				<label>Password Baru</label>
  				<input type="password" name="passBaru" class="form-control">
                <?= form_error('passBaru','<div class="text-small text-danger">', '</div>') ?>
  			</div>

  			<div class="form-grup">
  				<label>Ulangi Password Baru</label>
  				<input type="password" name="ulangPass" class="form-control">
  				<?= form_error('ulangPass','<div class="text-small text-danger">', '</div>') ?>
  			</div>
  			<br>
  			<button type="submit" class="btn btn-primary">Simpan</button>
  		</form>
  	</div>
  </div>
                    
    </div>

</div>