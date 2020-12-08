<section class="content-header">
      <h1>Report
        <small>View Data pendapatan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Data pendapatan</li>
      </ol>
    </section>
    <section class="content">
    <div class="box">

        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
        	    <!-- <tr><td>Grand Total Hari ini : </td><td><?= rupiah($row)?></td></tr>
                -->
        	</table>
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-file"></i> Report Data pendapatan</h3>
              </div><br>
              <form action="<?php echo base_url() ?>report/pendapatan_per" method="post" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="tgl_1" name="tgl_1" required="">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="tgl_2" name="tgl_2" required="">
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="btnCetak">Lihat</button>
                </div>
              </form>
            </div>

        </div>
    </div>
    </section>
