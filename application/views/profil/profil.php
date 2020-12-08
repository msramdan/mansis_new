<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" alt="User profile picture">

              <h3 class="profile-username text-center"><?=ucfirst($this->fungsi->user_login()->name)?></h3>

              <!-- <p class="text-muted text-center"><?= $this->fungsi->user_login()->level?>             -->
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

              <p class="text-muted"><?=ucfirst($this->fungsi->user_login()->email)?></p>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?=ucfirst($this->fungsi->user_login()->address)?></p>

              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
              <li><a href="#settings" data-toggle="tab">Changed Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <form class="form-horizontal" action="<?php echo base_url() ?>user/edit_profil/<?=$this->fungsi->user_login()->user_id?>" enctype="multipart/form-data" role="form" method="post">
                  <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username*</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="username" placeholder="Username" readonly="" value="<?=$this->fungsi->user_login()->username?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name*</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name" required="" name="name" value="<?=$this->fungsi->user_login()->name?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email*</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="email" placeholder="Email" required="" name="email" value="<?=$this->fungsi->user_login()->email?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Perusahaan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="perusahaan" placeholder="perusahaan" readonly="" value="<?=$this->fungsi->user_login()->nama_perusahaan?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <textarea id="address" name="address" placeholder="Address" class="form-control"><?=$this->fungsi->user_login()->address?></textarea>
                    </div>
                  </div>
<!--                   <div class="form-group">
                    <label for="level" class="col-sm-2 control-label">Level*</label>
                    <?php if (($this->fungsi->user_login()->level)==1) { ?>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="level" placeholder="Name" required="" name="level" readonly="" value="Admin">
                        </div>
                     <?php }else{ ?>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="level" placeholder="Name" required="" name="level" readonly="" value="<?=$this->fungsi->user_login()->level?>">
                        </div>
                     <?php } ?>                
                  </div> -->
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="<?php echo base_url() ?>user/edit_password/<?=$this->fungsi->user_login()->user_id?>" enctype="multipart/form-data" role="form" method="post">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Old Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="lama" name="lama" placeholder="Old Password" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">New Password</label>
                    <div class="col-sm-10">
                       <input id="password" class="form-control" name="password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 6 Karakter' : ''); if(this.checkValidity()) form.passcon.pattern = this.value;" placeholder="Password Baru" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Verify Password</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="passcon" name="passcon" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan Password Yang Sama' : '');" placeholder="Verify Password" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>