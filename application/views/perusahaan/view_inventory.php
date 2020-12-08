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
          <div class="box-header">
            <h3 class="box-title">Inventory Perusahaan</h3>
          <!--   <div class="pull-right">
              <a href="<?=site_url('item')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div> -->
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Barcode</th>
                  <th>Nama</th>
                  <th>Kategori</th>
                  <th>Harga</th>
                  <th>Stock</th>
                  <th>Unit</th>
                  <th>View History Item</th>
<!--                   <th>Action</th> -->
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
                    <td><?= rupiah($value->price)?></td>
                    <td><?= ($value->in) - ($value->out) ?></td>
                    <td><?=$value->nama_unit?></td>
                    <td><a href="<?=site_url('perusahaan/view_his_inventory/'.$value->item_id.'/'.$value->perusahaan_id)?>" class ="btn btn-success btn-xs"><i class="fa fa-eye"></i>View</a></td>
      <!--               <td class="text-center" width="160px">
                      <a href="<?=site_url('item/edit/'.$value->item_id)?>" class ="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                      
                      <a href="<?=site_url('item/del/'.$value->item_id)?>" onclick="return confirm('Yakin Akan Hapus ?')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a> -->
                       
                        
                    </form>
             <!--        </td>  -->
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>

    </section>