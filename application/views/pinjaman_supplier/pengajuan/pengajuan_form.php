<section class="content-header">
  <h1>Pengajuan Supplier
    <small>Data Barang</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pengajuan Supplier</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Add Pengajuan</h3>
      <div class="pull-right">
        <?php $perusahaan_id = ($this->fungsi->user_login()->level == 1) ? $perusahaan_id : ''; ?>
        <a href="<?= site_url('pinjaman_supplier/pengajuan/view/' . $perusahaan_id) ?>" class="btn btn-warning btn-flat">
          <i class="fa fa-undo"></i>Back
        </a>
      </div>
    </div>
    <div class="box-body ">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form action="<?= site_url('pinjaman_supplier/pengajuan/process') ?>" method="post">
            <?php $perusahaan_id = ($this->fungsi->user_login()->level == 1) ? $perusahaan_id : $this->fungsi->user_login()->perusahaan_id; ?>
            <input type="hidden" name="perusahaan_id" value="<?= $perusahaan_id ?>" class="form-control " required>
            <input type="hidden" name="item_id" id="item_id" class="form-control " required>
            <input type="hidden" name="jumlah" id="jumlah" class="form-control " required>

            <div class="form-group">
              <label>No Ajuan*</label>
              <input type="text" name="no_ajuan" value="<?= $no_ajuan ?>" class="form-control " required readonly>
            </div>

            <div class="form-group ">
              <label>Tanggal Pengajuan*</label>
              <input type="date" name="date" value="<?= date('Y-m-d') ?>" class="form-control " required>
            </div>

            <div class="form-group ">
              <label for="supplier">Supplier*</label>
              <select name="supplier" class="form-control" required>
                <option value="">-- Pilih -- </option>
                <?php foreach ($supplier as $key => $data) {
                  echo '<option value="' . $data->supplier_id . '">' . $data->name . '</option>';
                } ?>
              </select>
            </div>

            <div class="form-group ">
              <label for="item">Pilih Barang*</label>
            </div>
            <div class="form-group input-group">
              <input type="text" readonly="" name="item" id="item" class="form-control" required="" autofocus="">
              <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>

            <div class="form-group ">
              <label for="price">Harga*</label>
              <input type="text" name="price" id="price" class="form-control " readonly>
            </div>

            <div class="form-group ">
              <label for="nama_categori">Kategori*</label>
              <input type="text" name="nama_categori" id="nama_categori" class="form-control " readonly>
            </div>

            <div class="form-group ">
              <label for="nama_unit">Unit*</label>
              <input type="text" name="nama_unit" id="nama_unit" class="form-control " readonly>
            </div>

            <div class="form-group ">
              <label for="keterangan">Keterangan*</label>
              <input type="text" name="keterangan" id="keterangan" value="<?= $row->keterangan ?>" class="form-control " required>
            </div>

            <div class="form-group ">
              <label for="jns_kas">Ambil dari Kas*</label>
              <select name="jns_kas" class="form-control" required>
                <option value="">-- Pilih -- </option>
                <?php foreach ($jns_kas as $key => $data) {
                  echo '<option value="' . $data->id . '">' . $data->nama . '</option>';
                } ?>
              </select>
            </div>

            <div class="form-group">
              <button type="submit" name="<?= $page ?>" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
              <button type="reset" class="btn btn">Reset</button>
            </div>
            <div class="card-footer small text-danger">
              * Wajib diisi
            </div>
          </form>

        </div>

      </div>


    </div>

    <div class="modal fade" id="modal-item">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Pilih Karyawan</h4>
          </div>
          <div class="modal-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Kategori</th>
                  <th>Unit</th>
                  <th>Nama Perusahaan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($item as $key => $data) { ?>
                  <tr>
                    <td><?= $data->name ?></td>
                    <td><?= rupiah($data->price) ?></td>
                    <td><?= $data->nama_categori ?></td>
                    <td><?= $data->nama_unit ?></td>
                    <td><?= $data->nama_perusahaan ?></td>
                    <td>
                      <button class="btn btn-xs btn-info" id="select" data-item_id="<?php echo $data->item_id ?>" data-name="<?php echo $data->name ?>" data-price="<?php echo $data->price ?>" data-nama_categori="<?php echo $data->nama_categori ?>" data-nama_unit="<?php echo $data->nama_unit ?>" data-nama_perusahaan="<?php echo $data->nama_perusahaan ?>">
                        <i class="fa fa-check"></i> Select
                      </button>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>

          </div>

        </div>
      </div>

    </div>
</section>

<script>
  $(document).ready(function() {
    $(document).on('click', '#select', function() {
      var item_id = $(this).data('item_id');
      var name = $(this).data('name');
      var price = number_format($(this).data('price'));
      var nama_categori = $(this).data('nama_categori');
      var nama_unit = $(this).data('nama_unit');
      $('#item_id').val(item_id);
      $('#item').val(name);
      $('#price').val(price);
      $('#nama_categori').val(nama_categori);
      $('#nama_unit').val(nama_unit);
      $('#modal-item').modal('hide');
      $('#jumlah').val(price.replace(/\,/g, '', ));
    })
  })
</script>