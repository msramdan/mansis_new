<section class="content-header">
      <h1>Grand 
        <small>Grand Total</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Grand Total</li>
      </ol>
    </section>
    <section class="content">
    <div class="box">

        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <a href="<?=site_url('report/pendapatan')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
              <h2>Periode : <?php $a=$row2; echo date("d-M-Y", strtotime($a))?> s/d <?php $b=$row3; echo date("d-M-Y", strtotime($b))?></h2>
              <h2><tr><td>Total Penjualan : </td><td><?= rupiah($total_pendapatan)?></td></tr></h2>
              <h2><tr><td>Total Hutang : </td><td><?= rupiah($hutang)?></td></tr></h2>
              <h2><tr><td>Grand Total : </td><td><?= rupiah( $total_pendapatan + $hutang) ?></td></tr></h2>
          </table>


        </div>
    </div>
    </section>
