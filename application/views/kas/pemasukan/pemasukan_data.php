<section class="content-header">
  <h1>Pemasukan
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Transaksi Kas</li>
    <li class="active">Pemasukan</li>
  </ol>
</section>
<section class="content">
  <?php $this->view('messages') ?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Pemasukan</h3>
      <div class="pull-right">
        <a href="<?= site_url('kas/pemasukan_add') ?>" class="btn btn-primary btn-flat">
          <i class="fa fa-plus"></i>Add Pemasukan
        </a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Keterangan</th>
            <th>Dari Kas</th>
            <th>Untuk Akun</th>
            <th>Jumlah</th>
            <th>Nama Perusahaan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($row as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->tgl_transaksi ?></td>
              <td><?= $value->keterangan ?></td>
              <td><?= $value->nama_kas ?></td>
              <td><?= $value->nama_akun ?></td>
              <td><?= "Rp. " . number_format($value->jumlah, 2, ',', '.') ?></td>
              <td><?= $value->nama_perusahaan ?></td>
              <td class="text-center" width="160px">
                <a href="<?= site_url('kas/pemasukan_del/' . $value->kas_id) ?>" onclick="return confirm('Yakin Akan Hapus ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
                </form>
              </td>
            </tr>
          <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {})
</script>