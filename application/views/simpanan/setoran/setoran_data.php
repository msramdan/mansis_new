<section class="content-header">
  <h1>Setoran
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Simpanan</li>
    <li class="active">Setoran</li>
  </ol>
</section>
<section class="content">
  <?php $this->view('messages') ?>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Setoran</h3>
      <div class="pull-right">
        <a href="<?= site_url('simpanan/setoran_add') ?>" class="btn btn-primary btn-flat">
          <i class="fa fa-plus"></i>Add Setoran
        </a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Jenis Simpanan</th>
            <th>Nama Karyawan</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Nama Penyetor</th>
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
              <td><?= $value->jenis_simpanan ?></td>
              <td><?= $value->nama_karyawan ?></td>
              <td><?= $value->keterangan ?></td>
              <td><?= "Rp. " . number_format($value->jumlah, 2, ',', '.') ?></td>
              <td><?= $value->nama_kuasa ?></td>
              <td><?= $value->nama_perusahaan ?></td>
              <td class="text-center" width="160px">
                <a id="set_detail" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-detail" data-nama_karyawan=" <?php echo $value->nama_karyawan ?>" data-alamat_karyawan="<?php echo $value->alamat_karyawan ?>" data-phone_karyawan="<?php echo $value->phone_karyawan ?>" data-jumlah="<?php echo "Rp. " . number_format($value->jumlah, 2, ',', '.') ?>" data-jenis_simpanan="<?php echo $value->jenis_simpanan ?>" data-nama_perusahaan="<?php echo $value->nama_perusahaan ?>" data-tanggal="<?php echo $value->tgl_transaksi ?>" data-nama_kuasa="<?php echo $value->nama_kuasa ?>" data-identitas_kuasa="<?php echo $value->identitas_kuasa ?>" data-alamat_kuasa="<?php echo $value->alamat_kuasa ?>">
                  <i class="fa fa-eye"></i>Detail</a>

                <a href="<?= site_url('simpanan/setoran_del/' . $value->simpanan_id) . "/" . $value->jenis_id ?>" onclick="return confirm('Yakin Akan Hapus ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
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

<div class="modal fade" id="modal-detail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" arial-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Setoran Detail</h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered no-margin">
          <tbody>
            <tr>
              <th>Nama Karyawan</th>
              <td><input type="text" class="form-control" disabled id="nama_karyawan"></td>
            </tr>
            <tr>
              <th>Phone Karyawan</th>
              <td><input type="text" class="form-control" disabled id="phone_karyawan"></td>
            </tr>
            <tr>
              <th>Alamat Karyawan</th>
              <td><input type="text" class="form-control" disabled id="alamat_karyawan"></td>
            </tr>
            <tr>
              <th>Jenis Setoran</th>
              <td><input type="text" class="form-control" disabled id="jenis_simpanan"></td>
            </tr>
            <tr>
              <th>Jumlah Setoran</th>
              <td><input type="text" class="form-control" disabled id="jumlah"></td>
            </tr>
            <tr>
              <th>Tanggal</th>
              <td><input type="text" class="form-control" disabled id="tanggal"></td>
            </tr>
            <tr>
              <th>Nama Penyetor</th>
              <td><input type="text" class="form-control" disabled id="nama_kuasa"></td>
            </tr>
            <tr>
              <th>No Identitas Penyetor</th>
              <td><input type="text" class="form-control" disabled id="identitas_kuasa"></td>
            </tr>
            <tr>
              <th>Alamat Penyetor</th>
              <td><input type="text" class="form-control" disabled id="alamat_kuasa"></td>
            </tr>
          </tbody>

        </table>

      </div>

    </div>
  </div>

</div>

<script>
  $(document).ready(function() {
    $(document).on('click', '#set_detail', function() {
      var nama_karyawan = $(this).data('nama_karyawan');
      var alamat_karyawan = $(this).data('alamat_karyawan');
      var phone_karyawan = $(this).data('phone_karyawan');
      var jenis_simpanan = $(this).data('jenis_simpanan');
      var jumlah = $(this).data('jumlah');
      var nama_perusahaan = $(this).data('nama_perusahaan');
      var tanggal = $(this).data('tanggal');
      var nama_kuasa = $(this).data('nama_kuasa');
      var identitas_kuasa = $(this).data('identitas_kuasa');
      var alamat_kuasa = $(this).data('alamat_kuasa');
      $('#nama_karyawan').val(nama_karyawan);
      $('#alamat_karyawan').val(alamat_karyawan);
      $('#phone_karyawan').val(phone_karyawan);
      $('#jumlah').val(jumlah);
      $('#nama_perusahaan').val(nama_perusahaan);
      $('#jenis_simpanan').val(jenis_simpanan);
      $('#tanggal').val(tanggal);
      $('#nama_kuasa').val(nama_kuasa);
      $('#identitas_kuasa').val(identitas_kuasa);
      $('#alamat_kuasa').val(alamat_kuasa);
      $('#modal-item').modal('hide');
    })
  })
</script>