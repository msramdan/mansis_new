<section class="content-header">
      <h1>Piutang
        <small>Data Piutang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Piutang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Piutang</h3>
            <div class="pull-right">
              <a href="<?=site_url('report/piutang')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="<?=site_url('sale/update_process_piutang')?>" method="post">
                  <div class="form-group ">
                    <input type="hidden" name="sale_id" value="<?=$row->sale_id?>">
                    <label>Invoice</label>
                    <input readonly="" required="" type="text" name="" value="<?=$row->invoice?>" class="form-control ">
                  </div>
                  <div class="form-group ">

                    <label>Total belanja</label>
                    <input readonly="" required="" type="number" name="total_belanja" value="<?=$row->final_price?>" class="form-control ">
                  </div>
                  <div class="form-group ">

                    <label>Baru Dibayar</label>
                    <input readonly="" required="" type="number" name="" value="<?=$row->cash?>" class="form-control ">
                  </div>
                  <div class="form-group ">

                    <label>Sisa Hutang</label>
                    <input readonly="" required="" type="number" name="" value="<?=$row->remaining?>" class="form-control ">
                  </div>
                  <div class="form-group ">

                    <label>Bayar Hutang</label>
                    <input required="" type="number" name="bayar" class="form-control ">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="<?=$page?>" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Update</button>
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