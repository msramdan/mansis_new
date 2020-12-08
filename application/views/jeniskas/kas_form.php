<section class="content-header">
  <h1>Kas</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kas</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= ucfirst($page) ?> Kas</h3>
      <div class="pull-right">
        <a href="<?= site_url('jeniskas') ?>" class="btn btn-warning btn-flat">
          <i class="fa fa-undo"></i>Back
        </a>
      </div>
    </div>
    <div class="box-body ">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form action="<?= site_url('jeniskas/process') ?>" method="post">
            <div class="form-group ">
              <input type="hidden" name="id" value="<?= $row->id ?>">
              <label>Nama Kas*</label>
              <input type="text" name="nama" value="<?= $row->nama ?>" class="form-control " required>
            </div>

            <label>Aktif*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="aktif" id="radio1" value="Y" <?= ($row->aktif == 'Y') ?  'checked' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="aktif" id="radio2" value="T" <?= ($row->aktif == 'T') ? 'checked' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                T
              </label>
            </div>

            <label>Data Simpan*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="tmpl_simpan" id="radio1" value="Y" <?= ($row->tmpl_simpan == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="tmpl_simpan" id="radio2" value="T" <?= ($row->tmpl_simpan == 'T') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                T
              </label>
            </div>

            <label>Data Penarikan*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="tmpl_penarikan" id="radio1" value="Y" <?= ($row->tmpl_penarikan == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="tmpl_penarikan" id="radio2" value="T" <?= ($row->tmpl_penarikan == 'T') ? ' checked ' : ''; ?>style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                T
              </label>
            </div>


            <label>Data Pinjaman*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="tmpl_pinjaman" id="radio1" value="Y" <?= ($row->tmpl_pinjaman == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="tmpl_pinjaman" id="radio2" value="T" <?= ($row->tmpl_pinjaman == 'T') ? ' checked ' : ''; ?>style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                T
              </label>
            </div>

            <label>Data Bayar*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="tmpl_bayar" id="radio1" value="Y" <?= ($row->tmpl_bayar == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="tmpl_bayar" id="radio2" value="T" <?= ($row->tmpl_bayar == 'T') ? ' checked ' : ''; ?>style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                T
              </label>
            </div>

            <label>Data Pemasukan*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="tmpl_pemasukan" id="radio1" value="Y" <?= ($row->tmpl_pemasukan == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="tmpl_pemasukan" id="radio2" value="T" <?= ($row->tmpl_pemasukan == 'T') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                T
              </label>
            </div>

            <label>Data Pengeluaran*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="tmpl_pengeluaran" id="radio1" value="Y" <?= ($row->tmpl_pengeluaran == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="tmpl_pengeluaran" id="radio2" value="T" <?= ($row->tmpl_pengeluaran == 'T') ? ' checked ' : ''; ?>style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                T
              </label>
            </div>

            <label>Data Transfer*</label>
            <div class="form-group ">
              <input class="form-check-input" type="radio" name="tmpl_transfer" id="radio1" value="Y" <?= ($row->tmpl_transfer == 'Y') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio1">
                Y
              </label>
              <input class="form-check-input" type="radio" name="tmpl_transfer" id="radio2" value="T" <?= ($row->tmpl_transfer == 'T') ? ' checked ' : ''; ?> style="margin: 0px 5px;" required>
              <label class="form-check-label" for="radio2">
                T
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