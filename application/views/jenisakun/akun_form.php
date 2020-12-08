<section class="content-header">
  <h1>Akun</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Akun</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= ucfirst($page) ?> Akun</h3>
      <div class="pull-right">
        <a href="<?= site_url('jenisakun') ?>" class="btn btn-warning btn-flat">
          <i class="fa fa-undo"></i>Back
        </a>
      </div>
    </div>
    <div class="box-body ">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form action="<?= site_url('jenisakun/process') ?>" method="post">
            <div class="form-group ">
              <input type="hidden" name="id" value="<?= $row->id ?>">
              <label>Kode Aktiva*</label>
              <input type="text" name="kd_aktiva" value="<?= $row->kd_aktiva ?>" class="form-control " required>
            </div>
            <div class="form-group ">
              <label>Jenis Trans*</label>
              <input type="text" name="jns_trans" value="<?= $row->jns_trans ?>" class="form-control " required>
            </div>

            <label>Tipe Akun*</label>
            <div class="form-group" ">
              <select class=" custom-select custom-select-lg mb-3 form-control" name="akun" required>
              <option disabled selected>Pilih Akun</option>
              <option value="Aktiva" <?= ($row->akun == 'Aktiva') ? ' selected ' : ''; ?>>Aktiva</option>
              <option value="Pasiva" <?= ($row->akun == 'Pasiva') ? ' selected ' : ''; ?>>Pasiva</option>
              </select>
            </div>

            <label>Laba Rugi</label>
            <div class="form-group" ">
              <select class=" custom-select custom-select-lg mb-3 form-control" name="laba_rugi">
              <option disabled selected value="">Pilih Laba Rugi</option>
              <option value="PENDAPATAN" <?= ($row->laba_rugi == 'PENDAPATAN') ? ' selected ' : ''; ?>>PENDAPATAN</option>
              <option value="BIAYA" <?= ($row->laba_rugi == 'BIAYA') ? ' selected ' : ''; ?>>BIAYA</option>
              <option value="">(Tidak Ada)</option>
              </select>
            </div>

            <label>Data Pemasukan*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="pemasukan" id="radio1" value="Y" <?= ($row->pemasukan == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="pemasukan" id="radio2" value="N" <?= ($row->pemasukan == 'N') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                N
              </label>
            </div>

            <label>Data Pengeluaran*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="pengeluaran" id="radio1" value="Y" <?= ($row->pengeluaran == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="pengeluaran" id="radio2" value="N" <?= ($row->pengeluaran == 'N') ? ' checked ' : ''; ?>style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                N
              </label>
            </div>

            <label>Aktif*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="aktif" id="radio1" value="Y" <?= ($row->aktif == 'Y') ?  'checked' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="aktif" id="radio2" value="N" <?= ($row->aktif == 'N') ? 'checked' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                N
              </label>
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