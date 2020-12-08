<section class="content-header">
      <h1>Stock In
        <small>Barang Masuk / Pembelian</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaction</li>
        <li class="active">Stock In</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Add Stock In</h3>
            <div class="pull-right">
              <a href="<?=site_url('stockin')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="<?=site_url('stock/process')?>" method="post">
                  <div class="form-group ">
                    <label>Date*</label>
                    <input type="date" name="date" value="<?= date('Y-m-d') ?>" class="form-control "required>
                  </div>

                  <div class="form-group ">
                    <label for="barcode">Barcode*</label>
                  </div>
                  <div class="form-group input-group">
                    <input type="hidden" name="item_id" id="item_id">
                    <input type="text" readonly="" name="barcode" id="barcode" class="form-control" required="" autofocus="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                  </div>

                  <div class="form-group ">
                    <input type="hidden" name="id_ramdan" value="">
                    <label for="item_name">Item Name*</label>
                    <input type="text" name="item_name" id="item_name" class="form-control "required readonly="">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-8">
                        <label for="unit_name">Item Unit</label>
                        <input type="text" name="unit_name" class="form-control" id="unit_name" value="-" readonly="">
                      </div>
                      <div class="col-md-4">
                        <label for="stock">Initial Stock</label>
                        <input type="text" name="stock" class="form-control" id="stock" value="-" readonly="">
                      </div>
                    </div>
                  </div>

                  <?php if($this->fungsi->user_login()->level==1){ ?>
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
                 <?php } ?>

                  


                  <div class="form-group ">
                    <label for="supplier">Supplier</label>
                    <select name="supplier" class="form-control">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($supplier as $key => $data) {
                        echo '<option value="'.$data->supplier_id.'">'.$data->name.'</option>';
                      } ?>
                    </select>
                  </div>
                  <div class="form-group ">
                    <label for="qty">QTY*</label>
                    <input type="number" name="qty" id="qty" class="form-control " placeholder="" required="">
                  </div>
                  <div class="form-group ">
                    <label for="detail">Detail*</label>
                    <input type="text" name="detail" id="detail" class="form-control " placeholder="Kulakan / Tambahan / etc " required="">
                  </div>


                  <div class="form-group">
                    <button type="submit" name="in_add" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
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
    <div class="modal fade" id="modal-item">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Select Product Item</h4>
          </div>
          <div class="modal-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>Barcode</th>
                  <th>Name</th>
                  <th>Unit</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($item as $key => $data) { ?>
                    <tr>
                      <td><?= $data->barcode ?></td>
                      <td><?= $data->name ?></td>
                      <td><?= $data->nama_unit ?></td>
                      <td><?= rupiah($data->price) ?></td>
                      <td><?= $data->stock ?></td>
                      <td>
                        <button class="btn btn-xs btn-info" id="select"
                          data-id2="<?php echo $data->item_id ?>"
                          data-barcode="<?php echo $data->barcode ?>"
                          data-name="<?php echo $data->name ?>"
                          data-name_unit="<?php echo $data->nama_unit ?>"
                          data-stock="<?php echo $data->stock ?>">


                          <i class="fa fa-check"></i> Select
                        </button>
                      </td>
                    </tr>
                  <?php } ?>
                  

                
              </tbody>
            </table>
            
            
          </div>
          
        </div>
      </div>
      
    </div>

    <script>
      $(document).ready(function(){
        $(document).on('click','#select',function(){
          var item_id = $(this).data('id2');
          var barcode = $(this).data('barcode');
          var name = $(this).data('name');
          var name_unit = $(this).data('name_unit');
          var stock = $(this).data('stock');
          $('#item_id').val(item_id);
          $('#barcode').val(barcode);
          $('#item_name').val(name);
          $('#unit_name').val(name_unit);
          $('#stock').val(stock);
          $('#modal-item').modal('hide');
        })
      })
    </script>