<?php if ($this->uri->segment(3) == $this->fungsi->user_login()->perusahaan_id || $this->fungsi->user_login()->level ==1  ) { ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<section class="content-header">
      <h1>Absen
        <small>Absen Karyawan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Absen</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">
          <div class="box-header">
<!--             <div class="col-md-4">
              <label>Filter Data :</label>
            <div class="form-group input-group">
              <input type="text" name="dates" id="dates" class="form-control " autofocus="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                  </div>
            </div> -->
          </div>

          <div class="box-body table-responsive">

            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Karyawan</th>
                  <th>Nama Karyawan</th>
                  <th>Status</th>
                  <th>Status Absen</th>
                  <th>Tanggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
                  <th>Lama Jam Kerja(Int)</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            
          </div>

    </section>
        <script>
  $(document).ready(function(){
    $('#table1').DataTable({
      "processing": true,
        "serverSide": true,
        "ajax": {
          "url" :"<?=site_url('absen/get_ajax')?>",
          data: {'perusahaan_id':<?php echo $this->uri->segment(3) ?>},
          "type" :"POST"
        } 

    })
  })
</script>

    <?php }else{
  redirect('auth/blocked');
 }