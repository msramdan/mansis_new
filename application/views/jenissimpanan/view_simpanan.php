<section class="content-header">
  <h1>Jenis Simpanan
    <small>List Jenis Simpanan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Jenis Simpanan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php $this->view('messages') ?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Simpanan</h3>
      <div class="pull-right">
        <a href="<?= site_url('jenissimpanan/add') ?>" class="btn btn-primary btn-flat">
          <i class="fa fa-plus"></i>Create
        </a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr>
            <th>No</th>
            <th>Lama Simpanan</th>
            <th>Izin Tampil</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($row->result() as $key => $value) { ?>
            <tr>
              <td width="50px"><?= $no++ ?></td>
              <td class="text-center" width="300px"><?= $value->ket ?></td>
              <td class="text-center" width="300px"><?= $value->tampil ?></td>
              <td class="text-center" width="200px" style="display:inline-block;">
                <a href="<?= site_url('jenissimpanan/edit/' . $value->id) ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                <a href="<?= site_url('jenissimpanan/del/' . $value->id) ?>" onclick="return confirm('Yakin Akan Hapus ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
                </form>
              </td>
            </tr>
          <?php
          } ?>
        </tbody>

      </table>

    </div>

</section>