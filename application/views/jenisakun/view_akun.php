<section class="content-header">
  <h1>Jenis Akun
    <small>List Jenis Akun</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Jenis Akun</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php $this->view('messages') ?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Akun</h3>
      <div class="pull-right">
        <a href="<?= site_url('jenisakun/add') ?>" class="btn btn-primary btn-flat">
          <i class="fa fa-plus"></i>Create
        </a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr>
            <th>No</th>
            <th>KD Aktiva</th>
            <th>Jenis Trans</th>
            <th>Akun</th>
            <th>Laba Rugi</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
            <th>Aktif</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($row->result() as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td class="text-center" width="160px"><?= $value->kd_aktiva ?></td>
              <td class="text-center"><?= $value->jns_trans ?></td>
              <td class="text-center"><?= $value->akun ?></td>
              <td class="text-center"><?= $value->laba_rugi ?></td>
              <td class="text-center"><?= $value->pemasukan ?></td>
              <td class="text-center"><?= $value->pengeluaran ?></td>
              <td class="text-center"><?= $value->aktif ?></td>
              <td class="text-center" width="100px" style="display:inline-block;">
                <a href="<?= site_url('jenisakun/edit/' . $value->id) ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                <a href="<?= site_url('jenisakun/del/' . $value->id) ?>" onclick="return confirm('Yakin Akan Hapus ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>


                </form>
              </td>
            </tr>
          <?php
          } ?>

        </tbody>

      </table>

    </div>

</section>