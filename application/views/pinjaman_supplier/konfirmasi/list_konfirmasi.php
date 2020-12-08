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
            <th>Tanggal Bayar</th>
            <th>Jumlah Bayar</th>
            <th>Denda</th>
            <th>Keterangan</th>
            <th>Status Angsuran</th>
            <th>Bukti</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          $count_angsuran_ke = count($row->result());
          foreach ($row->result() as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->tgl_bayar ?> </td>
              <td><?= rupiah($value->jumlah_bayar) ?></td>
              <td><?= ($value->denda == '') ? 0 : $value->denda ?></td>
              <td><?= $value->keterangan ?></td>
              <td><?= $value->status_angsuran ?></td>
              <td><a id="cek_bukti" href="javascript:void(0)" data-path="<?= base_url('assets/uploads/bukti_angsuran/') . $value->photo_bukti ?>" class="btn btn-primary" onclick="buka_bukti('<?= base_url('assets/uploads/bukti_angsuran/') . $value->photo_bukti ?>')" style="cursor: pointer;">Cek Bukti</a></td>
              <td><?php if ($value->status_angsuran == 'Menunggu Konfirmasi') {
                    echo '<button id="select" class="btn btn-success" data-status_angsuran="Terima" data-angsuran_id="' . $value->angsuran_id . '" data-perusahaan_id="' . $value->perusahaan_id . '" data-pinjaman_id="' . $value->pinjaman_id . '" data-toggle="modal" data-target="#modal-konfirmasi" style="margin: 0px 5px;">Terima</button>';
                    echo '<button id="select" class="btn btn-danger" data-status_angsuran="Tolak" data-angsuran_id="' . $value->angsuran_id . '" data-perusahaan_id="' . $value->perusahaan_id . '" data-pinjaman_id="' . $value->pinjaman_id . '" data-toggle="modal" data-target="#modal-konfirmasi" style="margin: 0px 5px;">Tolak</button>';
                  } ?></td>
            </tr>
          <?php
          } ?>
        </tbody>

      </table>

    </div>

    <div class="modal fade" id="modal-bukti" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Bukti Bayar Angsuran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center" width="400px">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-konfirmasi">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3>Yakin <span id="modal-title"></span> Angsuran?</h3>
          </div>
          <div class="modal-body">
            <form action="<?= site_url('pinjaman_supplier/konfirmasi/process') ?>" method="post">
              <input type="hidden" name="pinjaman_id" id="pinjaman_id" class="form-control">
              <input type="hidden" name="perusahaan_id" id="perusahaan_id" class="form-control">
              <input type="hidden" name="angsuran_id" id="angsuran_id" class="form-control">
              <div class="form-group ">
                <label for="status_angsuran">Status*</label>
                <input type="text" name="status_angsuran" id="status_angsuran" class="form-control" readonly>
              </div>
              <button type="submit" id="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Yes</button>
              <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function buka_bukti(path_bukti) {
    $('#modal-bukti').modal('show')
    $("#modal-bukti").find(".modal-body").html('<img class="rounded" src="' + path_bukti + '" alt="Bukti Pembayaran" width="300px">');
  }

  $(document).ready(function() {
    $(document).on('click', '#select', function() {
      var status = $(this).data('status_angsuran');
      var angsuran_id = $(this).data('angsuran_id');
      $('#angsuran_id').val(angsuran_id);
      var perusahaan_id = $(this).data('perusahaan_id');
      $('#perusahaan_id').val(perusahaan_id);
      var pinjaman_id = $(this).data('pinjaman_id');
      $('#pinjaman_id').val(pinjaman_id);

      if (status == 'Terima') {
        $('#submit').attr('name', 'terima');
        $('#modal-title').text(status);
        $('#status_angsuran').val(status);
      } else if (status == 'Tolak') {
        $('#submit').attr('name', 'tolak');
        $('#modal-title').text(status);
        $('#status_angsuran').val(status);
      }
    })
  })
</script>