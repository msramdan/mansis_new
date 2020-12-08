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
      <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Items</h3>
<!--             <div class="pull-right">
              <a href="<?=site_url('item/item')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div> -->
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="<?=site_url('item/process')?>" method="post">
            
                    <div class="form-group ">
                    <input type="hidden" name="item_id" value="<?=$row->item_id?>">
                    <label>Barcode*</label>
                    <input  type="text" name="barcode" value="<?=$row->barcode?>" class="form-control "required>
                  </div>
                  <div class="form-group ">
                    <label for="product_name">Item Name*</label>
                    <input type="text" name="product_name" id="product_name" value="<?=$row->name?>" class="form-control "required>
                  </div>
                  <div class="form-group ">
                    <label for="category">Category*</label>
                    <select name="category" class="form-control" required="">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($category_data->result() as $key => $data) { ?>
                         <?php if ($row->categori_id==$data->categori_id) { ?>
                        <option value="<?php echo $data->categori_id?>" selected><?php echo $data->name ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->categori_id?>"><?php echo $data->name ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>

            <?php if($this->fungsi->user_login()->level==1){?>
              <div class="form-group ">
                    <label for="perusahaan_id">Perusahaan</label>
                    <select name="perusahaan_id" class="form-control">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($perusahaan as $key => $data) { ?>
                         <?php if ($row->perusahaan_id==$data->perusahaan_id) { ?>
                        <option value="<?php echo $data->perusahaan_id?>" selected><?php echo $data->name ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->perusahaan_id?>"><?php echo $data->name ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                <?php }else{ ?>
                    <input type="hidden" name="perusahaan_id" value="<?= $this->fungsi->user_login()->perusahaan_id?>" class="form-control "required>
                <?php } ?>
                   <div class="form-group ">
                    <label for="unit">Unit*</label>
                    <select name="unit" class="form-control" required="">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($unit_data->result() as $key => $data2) { ?>
                         <?php if ($row->unit_id==$data2->unit_id) { ?>
                        <option value="<?php echo $data2->unit_id?>" selected><?php echo $data2->name ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data2->unit_id?>"><?php echo $data2->name ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group ">
                    <label for="price">Price*</label>
                    <input type="number" name="price" id="price" value="<?=$row->price?>" class="form-control "required>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="<?=$page?>" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
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