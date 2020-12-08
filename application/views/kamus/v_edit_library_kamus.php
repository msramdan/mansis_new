

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Edit Kata Kamus</h3>
            <div class="pull-right">
              <a href="<?=site_url('kamus/library_kamus/' .$this->uri->segment(3))?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
            <form action="<?php echo base_url(); ?>kamus/submit_edit/<?php echo $data_kamus['kamus_id'] ?>/<?php echo $data_kamus['bahasa_id'] ?>/<?php echo $data_kamus['kode_kamus'] ?>" method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Terjemahan Bahasa</label>
                  <input type="hidden" name="kamus_id" value="<?php echo $data_kamus['kamus_id']; ?>">
                  <input type="hidden" name="bahasa_id" value="<?php echo $data_kamus['bahasa_id']; ?>">
                  <input type="hidden" name="kode_kamus" value="<?php echo $data_kamus['kode_kamus']; ?>">
                  <input type="text" class="form-control" name="teks" id="exampleInputtext1" placeholder=""  required="" value="<?= $data_kamus['teks'] ?>">
                </div>

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
              </div>
            </form>
                
              </div>
              
            </div>
            
            
          </div>

    </section>




            