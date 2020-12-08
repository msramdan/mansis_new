<?php
$button_bayar_disable = '<button id="select" class="btn btn-danger btn-xs" style="padding:5px 10px; margin: 2px 2px;" data-toggle="modal" data-target="#modal-detail" data-status="Setuju" disabled><i class="fa fa-money"></i> Pembayaran Tidak Aktif</button>';
?>

<section class="content-header">
  <h1>Daftar Pinjaman Supplier
    <small>Data Pinjaman</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pinjaman Supplier</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php $this->view('messages') ?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Pinjaman Supplier <strong><?= $nama_perusahaan ?></strong></h3>
      <div class="pull-right">
        <?php $perusahaan_id = ($this->fungsi->user_login()->level == 1) ? $perusahaan_id : ''; ?>
        <a href="<?= site_url('pinjaman_supplier/pengajuan/add/' . $perusahaan_id) ?>" class="btn btn-primary btn-flat">
          <i class="fa fa-plus"></i>Tambahkan Pengajuan
        </a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Pinjam</th>
            <th>Supplier</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Alasan</th>
            <th>Status Lunas</th>
            <th>Ambil dari Kas</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($row->result() as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->tgl_pinjam ?> </td>
              <td><?= $value->nama_supplier ?></td>
              <td><?= $value->nama_item ?></td>
              <td><?= rupiah($value->jumlah) ?></td>
              <td><?= $value->alasan ?></td>
              <td><?= $value->status_lunas ?></td>
              <td><?= $value->nama_kas ?></td>
              <td><?= '' ?></td>
              <td class="text-center" width="160px">
                <?php
                $button_bayar = '<a href="' . site_url('pinjaman_supplier/angsuran/detail/' . $value->pinjaman_id) . '" class="btn btn-success btn-xs" style="padding:5px 10px; margin: 2px 2px;" ><i class="fa fa-money"></i> Bayar Angsuran</a>';
                $button_detail = '<a a href="' . site_url('pinjaman_supplier/angsuran/detail/' . $value->pinjaman_id) . '" class="btn btn-primary btn-xs" style="padding:5px 10px;" ><i class="fa fa-search"></i> Lihat Detail</a>';
                if ($this->fungsi->user_login()->level == 1) {
                  if ($value->status_lunas == 'Lunas') {
                    echo $button_detail;
                  } else if ($value->status_lunas == 'Belum') {
                    echo $button_bayar . $button_detail;
                  } else if ($value->status_lunas == 'Tidak Aktif') {
                    echo $button_bayar_disable . $button_detail;
                  }
                } else {
                  if ($value->status_lunas == 'Lunas') {
                    echo $button_detail;
                  } else if ($value->status_lunas == 'Belum') {
                    echo $button_bayar . $button_detail;
                  } else if ($value->status_lunas == 'Tidak Aktif') {
                    echo $button_bayar_disable . $button_detail;
                  }
                } ?>
                </form>
              </td>
            </tr>
          <?php
          } ?>

        </tbody>

      </table>

    </div>

</section>