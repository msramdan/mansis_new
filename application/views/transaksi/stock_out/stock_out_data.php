<section class="content-header">
      <h1>Stock Out
        <small>Barang Masuk / Pembelian</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaction</li>
        <li class="active">Stock Out</li>
      </ol>
    </section>
    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data stock Out</h3>
            <div class="pull-right">
              <a href="<?=site_url('stockout/add')?>" class="btn btn-primary btn-flat">
                <i class="fa fa-plus"></i>Add Stock Out
              </a>
            </div>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Lokasi perusahaan</th>
                  <th>Barcode</th>
                  <th>Product Item</th>
                  <th>QTY</th>
                  <th>Date</th>
                  <th>Info</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->nama_perusahaan?></td>
                    <td><?=$value->barcode?></td>
                    <td><?=$value->nama_item?></td>
                    <td><?=$value->qty?></td>
                    <td><?=indo_date($value->date)?></td>
                    <td><?=$value->detail?></td>
                    <td class="text-center" width="160px">
                      <a id="set_detail" class ="btn btn-success btn-xs"
                          data-toggle="modal" data-target="#modal-detail"
                          data-barcode="<?php echo $value->barcode ?>"
                          data-name_item="<?php echo $value->nama_item ?>"
                          data-name_supp="<?php echo $value->nama_supplier ?>"
                          data-detail="<?php echo $value->detail ?>"
                          data-qty="<?php echo $value->qty ?>"
                          data-date="<?php echo $value->date ?>">
                      <i class="fa fa-eye"></i>Detail</a>
                      
                      <a href="<?=site_url('stockout/del/'.$value->stock_id.'/'.$value->item_id)?>" onclick="return confirm('Yakin Akan Hapus ?')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>                       
                    </form>
                    </td> 
                  </tr>
                  <?php  
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>

    <div class="modal fade" id="modal-detail">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Stock Out Detail</h4>
          </div>
          <div class="modal-body table-responsive">
            <table class="table table-bordered no-margin">
              <tbody>
                <tr>
                  <th style="">Barcode</th>
                  <td><span id="barcode"></span></td>
                </tr>
                <tr>
                  <th style="">Nama Item</th>
                  <td><span id="name_item"></span></td>
                </tr>
                <tr>
                  <th style="">Nama SUpplier</th>
                  <td><span id="name_supp"></span></td>
                </tr>
                <tr>
                  <th style="">Detail</th>
                  <td><span id="detail"></span></td>
                </tr>
                <tr>
                  <th style="">QTY</th>
                  <td><span id="qty"></span></td>
                </tr>
                <tr>
                  <th style="">Date</th>
                  <td><span id="date"></span></td>
                </tr>
              </tbody>
               
            </table>
            
          </div>
          
        </div>
      </div>
      
    </div>

    <script>
      $(document).ready(function(){
        $(document).on('click','#set_detail',function(){
          var barcode = $(this).data('barcode');
          var name_item = $(this).data('name_item');
          var name_supp = $(this).data('name_supp');
          var detail = $(this).data('detail');
          var qty = $(this).data('qty');
          var date = $(this).data('date');
          $('#barcode').text(barcode);
          $('#name_item').text(name_item);
          $('#name_supp').text(name_supp);
          $('#detail').text(detail);
          $('#qty').text(qty);
          $('#date').text(date);
        })
      })
    </script>