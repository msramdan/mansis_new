<section class="content-header">
      <h1>Sub Menu
        <small>Sub Menu</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sub Menu</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Sub Menu</h3>
            <div class="pull-right">
              <a href="<?=site_url('user_menu')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="<?=site_url('user_sub_menu/process')?>" method="post">

                  <input type="hidden" name="id_ramdan" value="<?=$row->id?>">


                  <div class="form-group ">
                    <label for="menu_id">Nama Parent*</label>
                    <select name="menu_id" class="form-control">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($user_menu as $key => $data) { ?>
                         <?php if ($row->menu_id==$data->id) { ?>
                        <option value="<?php echo $data->id?>" selected><?php echo $data->menu ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->id?>"><?php echo $data->menu ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>











                  <div class="form-group ">
                    <label>Nama Menu*</label>
                    <input type="text" name="title" value="<?=$row->title?>" class="form-control "required>
                  </div>
                  <div class="form-group ">
                    <label>Url*</label>
                    <input type="text" name="url" value="<?=$row->url?>" class="form-control "required>
                  </div>
                  <div class="form-group ">
                    <label>Icon*</label>
                    <input type="text" name="icon" value="<?=$row->icon?>" class="form-control "required>
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