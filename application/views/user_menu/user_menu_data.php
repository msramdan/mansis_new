<section class="content-header">
  <h1>User Menu
    <small>User Menu</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">user_menu</li>
  </ol>
</section>



<section class="content">
  <?php $this->view('messages') ?>
  <div class="row">
    <div class="col-md-6">
      <div class="alert alert-warning alert-dismissible">
        Note : Ketika Menghapus Menu Parent maka sub menu yang di bawahnya akan terhapus Juga
        </div>

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Menu Parent</h3>
          <div class="pull-right">
            <a href="<?= site_url('user_menu/add') ?>" class="btn btn-primary btn-flat">
              <i class="fa fa-plus"></i> Create Menu Parent
            </a>
          </div>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="table1">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Icon</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($row->result() as $key => $value) { ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $value->menu ?></td>
                  <td><?= $value->icon ?></td>
                  <td class="text-center" width="160px">
                    <a href="<?= site_url('user_menu/edit/' . $value->id) ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>

                    <a href="<?= site_url('user_menu/del/' . $value->id) ?>" onclick="return confirm('Yakin Akan Hapus ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>


                    </form>
                  </td>
                </tr>
              <?php
              } ?>

            </tbody>

          </table>


        </div>
      </div>
    </div>

    <div class="col-md-6">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Sub Menu</h3>
          <div class="pull-right">
            <a href="<?= site_url('user_sub_menu/add') ?>" class="btn btn-primary btn-flat">
              <i class="fa fa-plus"></i> Create Sub Menu
            </a>
          </div>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="table2">
            <thead>
              <tr>
                <th>No</th>
                <th>Parent</th>
                <th>Sub Menu</th>
                <th>Url</th>
                <th>Icon</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($row2->result() as $key => $value) { ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $value->menu ?></td>
                  <td><?= $value->title ?></td>
                  <td><?= $value->url ?></td>
                  <td><?= $value->icon ?></td>
                  <td class="text-center" width="160px">
                    <a href="<?= site_url('user_sub_menu/edit/' . $value->id) ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>

                    <a href="<?= site_url('user_sub_menu/del/' . $value->id) ?>" onclick="return confirm('Yakin Akan Hapus ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>


                    </form>
                  </td>
                </tr>
              <?php
              } ?>

            </tbody>

          </table>


        </div>
      </div>
    </div>

</section>