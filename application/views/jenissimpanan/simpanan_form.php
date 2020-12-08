<section class="content-header">
  <h1>Simpanan</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Simpanan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php $this->view('messages') ?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= ucfirst($page) ?> Simpanan</h3>
      <div class="pull-right">
        <a href="<?= site_url('jenissimpanan') ?>" class="btn btn-warning btn-flat">
          <i class="fa fa-undo"></i>Back
        </a>
      </div>
    </div>
    <div class="box-body ">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form action="<?= site_url('jenissimpanan/process') ?>" method="post">
            <div class="form-group ">
              <input type="hidden" name="id" value="<?= $row->id ?>">
              <label>Keterangan Simpanan*</label>
              <input type="text" name="ket" value="<?= $row->ket ?>" class="form-control " required>
            </div>
               <?php if($this->fungsi->user_login()->level==1){?>
              <div class="form-group ">
                    <label for="perusahaan_id">Perusahaan</label>
                    <select name="perusahaan_id" class="form-control">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($perusahaan as $key => $data) { ?>
                         <?php if ($row->perusahaan_id==$data->perusahaan_id) { ?>
                        <option value="<?php echo $data->perusahaan_id?>" selected><?php echo $data->name ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->perusahaan_id?>"><?php echo $data->name ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                <?php }else{ ?>
                    <input type="hidden" name="perusahaan_id" value="<?= $this->fungsi->user_login()->perusahaan_id?>" class="form-control "required>
                <?php } ?>

            <label>Izin Tampil*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="tampil" id="radio1" value="Y" <?= ($row->tampil == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="tampil" id="radio2" value="T" <?= ($row->tampil == 'T') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                T
              </label>
            </div>

            <div class="form-group">
              <button type="submit" name="<?= $page ?>" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
              <button type="reset" class="btn btn">Reset</button>
            </div>
            <div class="card-footer small text-danger">
              * Wajib diisi
            </div>
          </form>

        </div>

      </div>


    </div>

</section>