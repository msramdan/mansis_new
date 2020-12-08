<section class="content-header">
      <h1>customer
        <small>Pelanggan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> customers</h3>
            <div class="pull-right">
              <a href="<?=site_url('customer')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="<?=site_url('customer/process')?>" method="post">
                  <div class="form-group ">
                    <input type="hidden" name="id_ramdan" value="<?=$row->customer_id?>">
                    <label>Customer Name*</label>
                    <input type="text" name="customer_name" value="<?=$row->name?>" class="form-control "required>
                  </div>

<!--                   <div class="form-group ">
                    <label for="pasar_id">Pasar*</label>
                    <select name="pasar_id" class="form-control" required="">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($pasar_data->result() as $key => $data) { ?>
                         <?php if ($row->pasar_id==$data->pasar_id) { ?>
                        <option value="<?php echo $data->pasar_id?>" selected><?php echo $data->name ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->pasar_id?>"><?php echo $data->name ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div> -->
                  <div class="form-group">
                    <label>Gender*</label>
                    <select name="gender" class="form-control" value="<?=$row->gender?>" required>
                    <option value="">- Pilih -</option>
                    <option value="Laki Laki" <?= $row->gender =='Laki Laki' ? 'selected' : 'null' ?>>Laki Laki</option>
                    <option value="Perempuan" <?= $row->gender =='Perempuan' ? 'selected' : 'null' ?>>Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Phone*</label>
                    <input type="number" name="phone" value="<?=$row->phone?>" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label>Address*</label>
                    <textarea name="address" class="form-control" required=""><?=$row->address?></textarea>
                    
                  </div>

                  <div class="form-group">
                    <button type="submit" name="<?=$page?>" class="btn btn-success btn"><i class="fa fa-paper-plane" ></i>Save</button>
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