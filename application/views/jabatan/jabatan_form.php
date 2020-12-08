<section class="content-header">
      <h1>jabatan
        <small>Jabatan Karyawan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">jabatan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> jabatans</h3>
            <div class="pull-right">
              <a href="<?=site_url('jabatan')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="<?=site_url('jabatan/process')?>" method="post">
                  <div class="form-group ">
                    <input type="hidden" name="id_ramdan" value="<?=$row->jabatan_id?>">
                    <label>Jabatan Name*</label>
                    <input type="text" name="jabatan_name" value="<?=$row->name?>" class="form-control "required>
                  </div>

<!--                   <?php if($this->fungsi->user_login()->level==1){ ?>
                    <div class="form-group ">
                    <label for="perusahaan">Lokasi perusahaan</label>
                    <select name="perusahaan" class="form-control">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($perusahaan as $key => $data) {
                        echo '<option value="'.$data->perusahaan_id.'">'.$data->name.'</option>';
                      } ?>
                    </select>
                  </div>
                  <?php }else{ ?>
                    <div class="form-group ">
                      <input type="hidden" name="perusahaan" id="perusahaan" class="form-control "required readonly="" value="<?php echo $this->fungsi->user_login()->perusahaan_id ?>">
                    </div>
                 <?php } ?> -->

                  <div class="form-group">
                    <button type="submit" name="<?=$page?>" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
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