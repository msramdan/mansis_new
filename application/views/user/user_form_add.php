<section class="content-header">
      <h1>Users
        <small>Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
          <div class="box-header">
            <h3 class="box-title">Add Users</h3>
            <div class="pull-right">
              <a href="<?=site_url('user')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i>Back
              </a>
            </div>
          </div>
          <div class="box-body ">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <form action="" method="post">
                  <div class="form-group <?=form_error('fullname') ? 'has-error':null?> ">
                    <label>Name*</label>
                    <input type="text" name="fullname" value="<?=set_value('fullname')?>" class="form-control">
                    <?=form_error('fullname')?>
                  </div>
                  <div class="form-group <?=form_error('username') ? 'has-error':null?>">
                    <label>Username*</label>
                    <input type="text" name="username" value="<?=set_value('username')?>" class="form-control">
                    <?=form_error('username')?>
                  </div>

                  <div class="form-group <?=form_error('email') ? 'has-error':null?>">
                    <label>Email*</label>
                    <input type="email" name="email" value="<?=set_value('email')?>" class="form-control">
                    <?=form_error('email')?>
                  </div>

                  <div class="form-group <?=form_error('password') ? 'has-error':null?>">
                    <label>Password*</label>
                    <input type="password" name="password" value="<?=set_value('password')?>" class="form-control">
                    <?=form_error('password')?>
                  </div>
                  <div class="form-group <?=form_error('passconf') ? 'has-error':null?>">
                    <label>Confirmation Password*</label>
                    <input type="password" name="passconf" value="<?=set_value('passconf')?>" class="form-control">
                    <?=form_error('passconf')?>
                  </div>

                  <div class="form-group ">
                    <label for="perusahaan">Perusahaan</label>
                    <select name="perusahaan" class="form-control">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($perusahaan as $key => $data) {
                        echo '<option value="'.$data->perusahaan_id.'">'.$data->name.'</option>';
                      } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" value="<?=set_value('address')?>" class="form-control"><?=set_value('address')?></textarea>
                    <?=form_error('address')?>
                  </div>


                  <div class="form-group ">
                    <label for="level">level*</label>
                    <select name="level" class="form-control">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($level as $key => $data) {
                        echo '<option value="'.$data->id.'">'.$data->role.'</option>';
                      } ?>
                    </select>
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
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