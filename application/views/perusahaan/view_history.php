<section class="content-header">
      <h1>Items
        <small>Data Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Items</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">
          <!-- <div class="box-header">
            <h3 class="box-title">Data Items</h3>
            <div class="pull-right">
              <a href="<?=site_url('item/add')?>" class="btn btn-primary btn-flat">
                <i class="fa fa-plus"></i>Create Product Item
              </a>
            </div>
          </div> -->
      <!--     <div class="box-header">
            <h3 class="box-title">Inventory perusahaan</h3>
            <div class="pull-right">
              <a href="<?=site_url('perusahaan/view_inventory/'.$this->uri->segment(4))?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div> -->
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Barcode</th>
                  <th>Nama</th>
                  <th>Kategori</th>
                  <th>Type</th>
                  <th>Harga</th>
                  <th>QTY</th>
                  <th>Unit</th>
                  <th>Tanggal</th>
                  <th>Desk</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->barcode?><br>
                      <a href="<?=site_url('item/qrcode/'.$value->item_id)?>" class ="btn btn-default btn-xs">Generate<i class="fa fa-barcode"></i></a>
                    </td>
                    <td><?=$value->nama_item?></td>
                    <td><?=$value->nama_categori?></td> 
                    <td><?=$value->type?></td>                    
                    <td><?= rupiah($value->price)?></td>
                    <td><?=$value->qty?></td>
                    <td><?=$value->nama_unit?></td>
                    <td><?=$value->created?></td>
                    <td><?=$value->detail?></td>

                       
                        
                    </form>
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>