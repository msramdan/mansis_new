<section class="content-header">
  <h1>Jenis Kas
    <small>List Jenis Kas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Jenis Kas</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php $this->view('messages') ?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Kas</h3>
      <div class="pull-right">
        <a href="<?= site_url('jeniskas/add') ?>" class="btn btn-primary btn-flat">
          <i class="fa fa-plus"></i>Create
        </a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Aktif</th>
            <th>Simpan</th>
            <th>Penarikan</th>
            <th>Pinjaman</th>
            <th>Bayar</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
            <th>Transfer</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($row->result() as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td class="text-center" width="160px"><?= $value->nama ?></td>
              <td class="text-center"><?= $value->aktif ?></td>
              <td class="text-center"><?= $value->tmpl_simpan ?></td>
              <td class="text-center"><?= $value->tmpl_penarikan ?></td>
              <td class="text-center"><?= $value->tmpl_pinjaman ?></td>
              <td class="text-center"><?= $value->tmpl_bayar ?></td>
              <td class="text-center"><?= $value->tmpl_pemasukan ?></td>
              <td class="text-center"><?= $value->tmpl_pengeluaran ?></td>
              <td class="text-center"><?= $value->tmpl_transfer ?></td>
              <td class="text-center" width="100px" style="display:inline-block;">
                <a href="<?= site_url('jeniskas/edit/' . $value->id) ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Update</a>
                <a href="<?= site_url('jeniskas/del/' . $value->id) ?>" onclick="return confirm('Yakin Akan Hapus ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>


                </form>
              </td>
            </tr>
          <?php
          } ?>

        </tbody>

      </table>

    </div>

</section>