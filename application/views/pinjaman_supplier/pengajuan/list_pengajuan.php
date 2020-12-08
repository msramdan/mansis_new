<?php
$button_setuju_disable = '<button id="select" class="btn btn-success btn-xs" style="padding:5px 10px; margin: 2px 2px;" disabled><i class="fa fa-check"></i> Menunggu Persetujuan</button>';

$button_lunas_disable = '<button id="select" class="btn btn-success btn-xs" style="padding:5px 10px; margin: 2px 2px;" disabled><i class="fa fa-check"></i> Pembayaran Pinjaman Lunas</button>';

$button_tunda_disable = '<button id="select" class="btn btn-primary btn-xs" style="padding:5px 10px; margin: 2px 2px;"  disabled><i class="fa fa-question-circle"></i> Pengajuan Ditunda</button>';

$button_tolak_disable = '<button id="select" class="btn btn-warning btn-xs" style="padding:5px 10px; margin: 2px 2px;" disabled><i class="fa fa-close"></i> Pengajuan Ditolak</button>';

$button_laksanakan_disable = '<button id="select" class="btn btn-success btn-xs" style="padding:5px 10px; margin: 2px 2px;" disabled><i class="fa fa-paper-plane"></i> Telah Dilaksanakan</button>';

$button_laksanakan_disable_2 = '<button id="select" class="btn btn-success btn-xs" style="padding:5px 10px; margin: 2px 2px;" disabled><i class="fa fa-paper-plane"></i> Menunggu Pencairan Dana</button>';

$button_hapus_disable = '<button id="select" class="btn btn-danger btn-xs" style="padding:5px 10px; margin: 2px 2px;" disabled><i class="fa fa-trash"></i> Pengajuan Ditolak dan Dihapus</button>';
?>

<section class="content-header">
  <h1>Pengajuan Pinjaman Supplier
    <small>Data Pengajuan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pengajuan Supplier</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php $this->view('messages') ?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Pengajuan Supplier <strong><?= $nama_perusahaan ?></strong></h3>
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
            <th>Tanggal Pengajuan</th>
            <th>Supplier</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Ambil dari Kas</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($row->result() as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->tgl_input ?> </td>
              <td><?= $value->nama_supplier ?></td>
              <td><?= $value->nama_item ?></td>
              <td><?= rupiah($value->jumlah) ?></td>
              <td><?= $value->keterangan ?></td>
              <td><?= $value->status ?></td>
              <td><?= $value->nama_kas ?></td>
              <td><?= '' ?></td>
              <td class="text-center" width="160px">
                <?php

                $button_laksanakan = '<button id="select" class="btn btn-success btn-xs" style="padding:5px 10px; margin: 2px 2px;" data-toggle="modal" data-target="#modal-detail" data-pengajuan_id="' . $value->pengajuan_id . '" data-status="Laksanakan"><i class="fa fa-paper-plane"></i> Laksanakan</button>';
                $button_batal_laksanakan = '<button id="select" class="btn btn-danger btn-xs" style="padding:5px 10px; margin: 2px 2px;" data-toggle="modal" data-target="#modal-detail" data-pengajuan_id="' . $value->pengajuan_id . '" data-status="Batal Laksanakan"><i class="fa fa-paper-plane"></i> Batal Laksanakan</button>';
                $button_setuju = '<button id="select" class="btn btn-success btn-xs" style="padding:5px 10px; margin: 2px 2px;" data-toggle="modal" data-target="#modal-detail" data-pengajuan_id="' . $value->pengajuan_id . '" data-status="Setuju"><i class="fa fa-check"></i> Setujui</button>';
                $button_tunda = '<button id="select" class="btn btn-primary btn-xs" style="padding:5px 10px; margin: 2px 2px;" data-toggle="modal" data-target="#modal-detail" data-pengajuan_id="' . $value->pengajuan_id . '" data-status="Tunda"><i class="fa fa-question-circle"></i> Tunda</button>';
                $button_tolak = '<button id="select" class="btn btn-warning btn-xs" style="padding:5px 10px; margin: 2px 2px;" data-toggle="modal" data-target="#modal-detail" data-pengajuan_id="' . $value->pengajuan_id . '" data-status="Tolak"><i class="fa fa-close"></i> Tolak</button>';
                $button_hapus = '<button id="select" class="btn btn-danger btn-xs" style="padding:5px 10px; margin: 2px 2px;" data-toggle="modal" data-target="#modal-detail" data-pengajuan_id="' . $value->pengajuan_id . '" data-status="Hapus"><i class="fa fa-trash"></i> Hapus</button>';

                if ($this->fungsi->user_login()->level == 1) {
                  if ($value->status == 'Laksanakan') {
                    echo $button_batal_laksanakan;
                  } else if ($value->status == 'Setuju') {
                    echo $button_laksanakan . $button_tunda;
                  } else if ($value->status == 'Menunggu') {
                    echo $button_setuju . $button_tolak . $button_hapus;
                  } else if ($value->status == 'Tunda') {
                    echo $button_setuju . $button_hapus;
                  } else if ($value->status == 'Tolak') {
                    echo $button_tolak_disable;
                  } else if ($value->status == 'Hapus') {
                    echo $button_hapus_disable;
                  } else if ($value->status == 'Lunas') {
                    echo $button_lunas_disable;
                  }
                } else {
                  if ($value->status == 'Laksanakan') {
                    echo $button_laksanakan_disable;
                  } else if ($value->status == 'Setuju') {
                    echo $button_laksanakan_disable_2;
                  } else if ($value->status == 'Menunggu') {
                    echo $button_setuju_disable . $button_hapus;
                  } else if ($value->status == 'Tunda') {
                    echo $button_tunda_disable;
                  } else if ($value->status == 'Tolak') {
                    echo $button_tolak_disable;
                  } else if ($value->status == 'Hapus') {
                    echo $button_hapus_disable;
                  } else if ($value->status == 'Lunas') {
                    echo $button_lunas_disable;
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

    <div class="modal fade" id="modal-detail">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3>Yakin <span id="modal-title"></span> Pengajuan?</h3>
          </div>
          <div class="modal-body">
            <form action="<?= site_url('pinjaman_supplier/pengajuan/process') ?>" method="post">
              <input type="hidden" name="perusahaan_id" id="perusahaan_id" value="<?= $perusahaan_id ?>" class="form-control">
              <input type="hidden" name="pengajuan_id" id="pengajuan_id" class="form-control">
              <div class="form-group " id="tgl_cair_grup">
                <label>Tanggal Cair*</label>
                <input type="date" name="tgl_cair" value="<?= date('Y-m-d') ?>" class="form-control ">
              </div>
              <div class="form-group ">
                <label for="status">Status*</label>
                <input type="text" name="status" id="status" class="form-control" readonly>
              </div>
              <div class="form-group " id="alasan_grup">
                <label for="alasan">Alasan*</label>
                <input type="text" name="alasan" id="alasan" class="form-control ">
              </div>
              <div class="form-group" id="jns_akun_grup">
                <label for="akun_id">Jenis Transaksi*</label>
                <select name="akun_id" id="akun_id" class="form-control">
                  <option value="">-- Pilih -- </option>
                  <?php foreach ($jns_akun as $key => $data) {
                    echo '<option value="' . $data->id . '">' . $data->jns_trans . '</option>';
                  } ?>
                </select>
              </div>
              <div class="form-group d-flex justify-content-end">
                <button type="submit" id="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Yes</button>
                <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  $(document).ready(function() {
    $(document).on('click', '#select', function() {
      $('#tgl_cair_grup').hide();
      $('#alasan_grup').hide();
      $('#jns_akun_grup').hide();
      var status = $(this).data('status');
      var pengajuan_id = $(this).data('pengajuan_id');
      $('#pengajuan_id').val(pengajuan_id);

      if (status == 'Laksanakan') {
        $('#tgl_cair_grup').show();
        $('#alasan_grup').show();
        $('#jns_akun_grup').show();
        $('#submit').attr('name', 'laksanakan');
        $('#modal-title').text(status);
        $('#status').val(status);

        $('#submit').on('click', function(e) {
          if ($('#tgl_cair').val() == '') {
            alert('Tanggal Cair Belum Diatur');
            e.preventDefault();
          }
          if ($('#alasan').val() == '') {
            alert('Alasan Belum Diisi');
            e.preventDefault();
          }
          if ($("#akun_id").val() == '') {
            alert("Jenis Transaksi Belum Dipilih");
            e.preventDefault();
          }
        });
      } else if (status == 'Setuju') {
        $('#submit').attr('name', 'setuju');
        $('#modal-title').text(status);
        $('#status').val(status);
      } else if (status == 'Tunda') {
        $('#submit').attr('name', 'tunda');
        $('#modal-title').text(status);
        $('#status').val(status);
        $('#alasan').val('Tunda');
      } else if (status == 'Tolak') {
        $('#submit').attr('name', 'tolak');
        $('#modal-title').text(status);
        $('#status').val(status);
      } else if (status == 'Hapus') {
        $('#submit').attr('name', 'hapus');
        $('#modal-title').text(status);
        $('#status').val(status);
      } else if (status == 'Batal Laksanakan') {
        $('#submit').attr('name', 'batal_laksanakan');
        $('#modal-title').text(status);
        $('#status').val(status);
      }


    })
  })
</script>