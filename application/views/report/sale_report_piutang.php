<section class="content-header">
      <h1>Data
        <small>Piutang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Piutang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Piutang</h3>
          </div>
          <div class="box-body table-responsive">
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
                  <th>ACtion</th>
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
                    <td class="text-center" width="160px">
                      <button id="detail"
                      data-invoice="<?php echo $value->invoice ?>"
                      data-customer_name="<?=$value->customer_id == null ? "Umum" : $value->customer_name?>"
                      data-datetime="<?php echo $value->sale_created ?>"
                      data-cashiser="<?php echo $value->user_name ?>"
                      data-total="<?= rupiah($value->total_price)?>"
                      data-discount="<?= rupiah($value->discount)?>"
                      data-change="<?= rupiah($value->remaining)?>"
                      data-cash="<?= rupiah($value->cash)?>"
                      data-grandtotal="<?= rupiah($value->final_price)?>"
                      data-saleid="<?php echo $value->sale_id?>"
                      data-note="<?php echo $value->note ?>"
                      data-toggle="modal" data-target="#modal-detail" class ="btn btn-default btn-xs">Detail</button>
                      <a href="<?=site_url('sale/cetak/'.$value->sale_id)?>" target="_blank" class ="btn btn-success btn-xs"><i class="fa fa-print"></i>Print</a>
                      
                     <!--  <a href="<?=site_url('sale/del/'.$value->sale_id)?>" onclick="return confirm('Yakin Akan Hapus ?')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a> -->
                      <a href="<?=site_url('sale/piutang_edit/'.$value->sale_id)?>" class ="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                    </td>
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>

        <div class="modal fade" id="modal-detail">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Sales Report Detail</h4>
          </div>
          <div class="modal-body table-responsive">
            <table class="table table-bordered no-margin">
              <tbody>
                <tr>
                  <th style="width: 20%">Invoice</th>
                  <td style="width: 30%"><span id="invoice"></span></td>
                  <th style="width: 20%">Customer</th>
                  <td style="30%"><span id="cuts"></span></td>
                </tr>
                <tr>
                  <th style="">Date Time</th>
                  <td><span id="datetime"></span></td>
                  <th style="">Cashier</th>
                  <td><span id="cashiser"></span></td>
                </tr>
                <tr>
                  <th style="">Total</th>
                  <td><span id="total"></span></td>
                  <th style="">Cash</th>
                  <td><span id="cash"></span></td>
                </tr>
                <tr>
                  <th style="">Discount</th>
                  <td><span id="discount"></span></td>
                  <th style="">Change</th>
                  <td><span id="change"></span></td>
                </tr>
                <tr>
                  <th style="">Grand Total</th>
                  <td><span id="grandtotal"></span></td>
                  <th style="">Note</th>
                  <td><span id="note"></span></td>
                </tr>
                <tr>
                  <th style="">Product</th>
                  <td colspan="3"><span id="product"></span></td>
                </tr>
              </tbody>
               
            </table>
            
          </div>
          
        </div>
      </div>
      
    </div>
    <script type="text/javascript">
        $(document).on('click','#detail',function(){
          var invoice = $(this).data('invoice');
          var customer_name = $(this).data('customer_name');
          var datetime = $(this).data('datetime');
          var cashiser = $(this).data('cashiser');
          var total = $(this).data('total');
          var cash = $(this).data('cash');
          var discount = $(this).data('discount');
          var change = $(this).data('change');
          var grandtotal = $(this).data('grandtotal');
          var note = $(this).data('note');
          $('#invoice').text(invoice);
          $('#cuts').text(customer_name);
          $('#datetime').text(datetime);
          $('#cashiser').text(cashiser);
          $('#total').text(total);
          $('#cash').text(cash);
          $('#discount').text(discount);
          $('#change').text(change);
          $('#grandtotal').text(grandtotal);
          $('#note').text(note);
          var product = '<table class="table no-margin">'
          product +='<tr><th>Item</th><th>Harga</th><th>QTY</th><th>Discount</th><th>Total</th></tr>'
          $.getJSON('<?=site_url('report/sale_product_detail/') ?>'+$(this).data('saleid'),function(data){
            $.each(data, function(key, val){
              product += '<tr><td>'+val.name_item+'</td><td>'+val.price+'</td><td>'+val.qty+'</td><td>'+val.discount_item+'</td><td>'+val.total+'</td></tr>'
            })
            product +='</table>'
            $('#product').html(product)
          })
        })
    </script>