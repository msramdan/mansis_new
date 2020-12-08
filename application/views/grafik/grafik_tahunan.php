<section class="content-header">
      <h1>Grafik
        <small>Pelanggan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grafik</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Grafik Bulanan</h3>
            <div class="pull-right">
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="<?php echo base_url('grafik/grafik_penjualan_tahunan') ?>" method="post" target="_blank">
                  <div class="form-group ">
                    <label>Pilih Tahun*</label>
                    <select name="tahun" id="tahun" class="form-control" required>
                      <option value="">Pilih Tahun</option>
                      <?php foreach ($tahun as $key): ?>
                        <option <?php if ($year == $key['thn']) {echo 'selected';}?> value="<?php echo $key['thn'] ?>"><?php echo $key['thn'] ?></option>
                      <?php endforeach?>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="submit" id="btnSimpanBiaya" class="btn btn-success" target="_blank">LIHAT</button>
                    <button type="reset" class="btn btn">Reset</button>
                  </div>

                </form>
                
              </div>
              
            </div>
            
            
          </div>

    </section>