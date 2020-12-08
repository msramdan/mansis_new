<section class="content">
  <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <marquee direction="left" scrollamount="4" align="center" font-size="50px"><h4>Selamat datang, Web Aplikasi Manajemen Sistem PT Wahyu Arta Digital</h4></marquee>
  </div>

<!-- Script Untuk Menampilkan waktu real time -->
<center>

<script type="text/javascript">    
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function tampilkanwaktu(){
        //buat object date berdasarkan waktu saat ini
        var waktu = new Date();
        //ambil nilai jam, 
        //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length
        var sh = waktu.getHours() + ""; 
        //ambil nilai menit
        var sm = waktu.getMinutes() + "";
        //ambil nilai detik
        var ss = waktu.getSeconds() + "";
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);"> 
  <center>
<h1>              
<span id="clock"></span></h1> 
</center>
<?php
$hari = date('l');
/*$new = date('l, F d, Y', strtotime($Today));*/
if ($hari=="Sunday") {
  echo "Minggu";
}elseif ($hari=="Monday") {
  echo "Senin";
}elseif ($hari=="Tuesday") {
  echo "Selasa";
}elseif ($hari=="Wednesday") {
  echo "Rabu";
}elseif ($hari=="Thursday") {
  echo("Kamis");
}elseif ($hari=="Friday") {
  echo "Jum'at";
}elseif ($hari=="Saturday") {
  echo "Sabtu";
}
?>,
<?php
$tgl =date('d');
echo $tgl;
$bulan =date('F');
if ($bulan=="January") {
  echo " Januari ";
}elseif ($bulan=="February") {
  echo " Februari ";
}elseif ($bulan=="March") {
  echo " Maret ";
}elseif ($bulan=="April") {
  echo " April ";
}elseif ($bulan=="May") {
  echo " Mei ";
}elseif ($bulan=="June") {
  echo " Juni ";
}elseif ($bulan=="July") {
  echo " Juli ";
}elseif ($bulan=="August") {
  echo " Agustus ";
}elseif ($bulan=="September") {
  echo " September ";
}elseif ($bulan=="October") {
  echo " Oktober ";
}elseif ($bulan=="November") {
  echo " November ";
}elseif ($bulan=="December") {
  echo " Desember ";
}
$tahun=date('Y');
echo $tahun;
?>
</center>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Karyawan</span>
              <span class="info-box-number"><?=$this->fungsi->karyawan() ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-cube"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Item</span>
              <span class="info-box-number"><?=$this->fungsi->count_item() ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Supplier</span>
              <span class="info-box-number"><?=$this->fungsi->count_supplier() ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

<!--         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Customers</span>
              <span class="info-box-number"><?=$this->fungsi->customer() ?></span>
            </div>
          </div>
        </div> -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Raker Karyawan</span>
              <span class="info-box-number"><?=$this->fungsi->raker() ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <br>
      </div>
      <br>
      <br>
      <div class="row">

<!--         <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">10 Transaksi Terbaru</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div><br><br>
               <div class="box-body" style="overflow-x: scroll; ">
                 <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Invoice</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Total</th>
                  <th>Discount</th>
                  <th>Grand Total</th>
                  <th>Cash</th>
                  <th>Change</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->invoice?></td>
                     <td><?=$value->date?></td>
                    <td><?=$value->customer_id == null ? "Umum" : $value->customer_name?></td>
                    <td><?= rupiah($value->total_price)?></td>
                    <td><?= rupiah($value->discount)?></td>
                    <td><?= rupiah($value->final_price)?></td>
                    <td><?= rupiah($value->cash)?></td>
                    <td><?= rupiah($value->remaining)?></td>
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
        
             
            </div>
             
            </div>
          </div>
        </div> -->

        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Stok In Hari Ini</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div><br><br>
               <div class="box-body" style="overflow-x: scroll; ">
                <table class="table table-bordered table-striped" id="table2">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Barcode</th>
                  <th>Product Item</th>
                  <th>QTY</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($stock_in as $key => $value2) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value2->barcode?></td>
                    <td><?=$value2->nama_item?></td>
                    <td><?=$value2->qty?></td>
                    <td><?=indo_date($value2->date)?></td> 
                  </tr>
                  <?php  
                } ?>
              </tbody>
            </table>
            </div>
             
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Stok Out Hari Ini</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div><br><br>
              <div class="box-body" style="overflow-x: scroll; ">
                <table class="table table-bordered table-striped" id="table3">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Barcode</th>
                  <th>Product Item</th>
                  <th>QTY</th>
                  <th>Date</th>
                  <th>Info</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($stock_out as $key => $value3) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value3->barcode?></td>
                    <td><?=$value3->nama_item?></td>
                    <td><?=$value3->qty?></td>
                    <td><?=indo_date($value3->date)?></td>
                    <td><?=$value3->detail?></td>
                  </tr>
                  <?php  
                } ?>
              </tbody>
            </table>

             
            </div>

            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>