    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Tambah kata/kalimat</h3>
            <div class="pull-right">
              <a href="<?=site_url('bahasa')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">

                  <form action="<?php echo base_url(); ?>kamus/submit_kamus_kata" method="post" enctype="multipart/form-data" role="form">
    <div class="box-body">
      <div class="form-group">
        <label for="kode_kamus">Kode Kamus</label>
        <input type="" class="form-control" name="kode_kamus" id="exampleInputtext1" required="" value="<?= $kodeunik; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="ina">Bahasa Indonesia</label>
        <input type="text" class="form-control" name="ina" id="exampleInputtext1" placeholder="ex.Bahasa"  required="">
        <input type="hidden" name="ina_id" value=1>
      </div>
      <div class="form-group">
        <label for="eu">Bahasa Inggris</label>
        <input type="text" class="form-control" name="eu" id="exampleInputtext1" placeholder="ex.language"  required="">
        <input type="hidden" name="eu_id" value=2>
      </div>
    </div>
    <div class="box-footer">
      <button type="submit" name="submit" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
    </div>
  </form>



                
              </div>
              
            </div>
            
            
          </div>

    </section>