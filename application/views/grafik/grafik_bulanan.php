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
                <form action="<?php echo base_url('grafik/grafik_penjualan_bulanan') ?>" method="post" target="_blank">
                  <div class="form-group ">
                    <label>Pilih Bulan*</label>
                    <select name="bulan" id="bulan" class="form-control" required>
                      <option value="">Pilih Bulan</option>
                      <option <?php if ($bulan == '01') {echo 'selected';}?> value="01">Januari</option>
                      <option <?php if ($bulan == '02') {echo 'selected';}?> value="02">Februari</option>
                      <option <?php if ($bulan == '03') {echo 'selected';}?> value="03">Maret</option>
                      <option <?php if ($bulan == '04') {echo 'selected';}?> value="04">April</option>
                      <option <?php if ($bulan == '05') {echo 'selected';}?> value="05">Mei</option>
                      <option <?php if ($bulan == '06') {echo 'selected';}?> value="06">Juni</option>
                      <option <?php if ($bulan == '07') {echo 'selected';}?> value="07">Juli</option>
                      <option <?php if ($bulan == '08') {echo 'selected';}?> value="08">Agustus</option>
                      <option <?php if ($bulan == '09') {echo 'selected';}?> value="09">September</option>
                      <option <?php if ($bulan == '10') {echo 'selected';}?> value="10">Oktober</option>
                      <option <?php if ($bulan == '11') {echo 'selected';}?> value="11">November</option>
                      <option <?php if ($bulan == '12') {echo 'selected';}?> value="12">Desember</option>
                    </select>
                  </div>
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