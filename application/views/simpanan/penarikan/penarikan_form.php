<section class="content-header">
    <h1>Penarikan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Simpanan</li>
        <li class="active">Penarikan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add Penarikan</h3>
            <div class="pull-right">
                <a href="<?= site_url('simpanan/penarikan') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i>Back
                </a>
            </div>
        </div>
        <div class="box-body ">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('simpanan/process') ?>" method="post">
                        <div class="form-group ">
                            <label>Date*</label>
                            <input type="date" name="date" value="<?= date('Y-m-d') ?>" class="form-control " required>
                        </div>
                        <input type="hidden" name="karyawan_id" id="karyawan_id">
                        <input type="hidden" name="perusahaan_id" id="perusahaan_id">
                        <input type="hidden" name="ktp" id="ktp">

                        <div class="form-group ">
                            <label for="nama_karyawan">Nama Karyawan*</label>
                        </div>
                        <div class="form-group input-group">
                            <input type="text" readonly="" name="nama_karyawan" id="nama_karyawan" class="form-control" required="" autofocus="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" id="alamat" value="-" readonly="">
                                </div>
                                <div class="col-md-4">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="-" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="nama_jabatan">Nama Jabatan</label>
                                    <input type="text" name="nama_jabatan" class="form-control" id="nama_jabatan" value="-" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="nama_perusahaan">Nama Perusahaan</label>
                                    <input type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan" value="-" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="jns_simpanan">Jenis Simpanan*</label>
                            <select name="jns_simpanan" class="form-control" required>
                                <option value="">-- Pilih -- </option>
                                <?php foreach ($jns_simpanan as $key => $data) {
                                    echo '<option value="' . $data->id . '">' . $data->ket . '</option>';
                                } ?>
                            </select>
                        </div>

                        <div class="form-group ">
                            <label for="jns_kas">Jenis Kas*</label>
                            <select name="jns_kas" class="form-control" required>
                                <option value="">-- Pilih -- </option>
                                <?php foreach ($jns_kas as $key => $data) {
                                    echo '<option value="' . $data->id . '">' . $data->nama . '</option>';
                                } ?>
                            </select>
                        </div>

                        <div class="form-group ">
                            <label for="jumlah">Jumlah*</label>
                            <input type="hidden" name="jumlah" id="jumlah" class="form-control " placeholder="">
                            <input type="text" name="jumlah_txt" id="jumlah_txt" class="form-control " placeholder="" required="">
                        </div>
                        <div class="form-group ">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control " placeholder="Keterangan">
                        </div>
                        <hr style="border:1px solid black; margin-bottom:5px;">
                        <span class="text-muted">*Kosongkan jika data sama dengan karyawan yang dipilih</span>
                        <div class="form-group ">
                            <label for="nama_kuasa">Nama Pengambil</label>
                            <input type="text" name="nama_kuasa" id="nama_kuasa" class="form-control " placeholder="Nama Penyetor">
                        </div>
                        <div class="form-group ">
                            <label for="identitas_kuasa">No Identitas Pengambil</label>
                            <input type="text" name="identitas_kuasa" id="identitas_kuasa" class="form-control " placeholder="No Identitas Penyetor">
                        </div>
                        <div class="form-group ">
                            <label for="alamat_kuasa">Alamat Penyetor</label>
                            <input type="text" name="alamat_kuasa" id="alamat_kuasa" class="form-control " placeholder="Alamat Penyetor">
                        </div>

                        <div class="form-group">
                            <button type="submit" name="penarikan_add" id="penarikan_add" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
                            <button type="reset" class="btn btn">Reset</button>
                        </div>
                        <div class="card-footer small text-danger">
                            * Wajib diisi
                        </div>
                    </form>

                </div>

            </div>


        </div>

</section>
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
                            <th>Alamat</th>
                            <th>Phone</th>
                            <th>Nama Jabatan</th>
                            <th>Nama Perusahaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($karyawan as $key => $data) { ?>
                            <tr>
                                <td><?= $data->name ?></td>
                                <td><?= $data->alamat ?></td>
                                <td><?= $data->phone ?></td>
                                <td><?= $data->nama_jabatan ?></td>
                                <td><?= $data->nama_perusahaan ?></td>
                                <td>
                                    <button class="btn btn-xs btn-info" id="select" data-karyawan_id="<?php echo $data->karyawan_id ?>" data-nama_karyawan=" <?php echo $data->name ?>" data-alamat="<?php echo $data->alamat ?>" data-phone="<?php echo $data->phone ?>" data-nama_jabatan="<?php echo $data->nama_jabatan ?>" data-nama_perusahaan="<?php echo $data->nama_perusahaan ?>" data-perusahaan_id="<?php echo $data->perusahaan_id ?>" data-ktp="<?php echo $data->ktp ?>">
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

<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var karyawan_id = $(this).data('karyawan_id');
            var nama_karyawan = $(this).data('nama_karyawan');
            var alamat = $(this).data('alamat');
            var phone = $(this).data('phone');
            var nama_jabatan = $(this).data('nama_jabatan');
            var nama_perusahaan = $(this).data('nama_perusahaan');
            var perusahaan_id = $(this).data('perusahaan_id');
            var ktp = $(this).data('ktp');
            $('#karyawan_id').val(karyawan_id);
            $('#nama_karyawan').val(nama_karyawan);
            $('#alamat').val(alamat);
            $('#phone').val(phone);
            $('#nama_jabatan').val(nama_jabatan);
            $('#nama_perusahaan').val(nama_perusahaan);
            $('#perusahaan_id').val(perusahaan_id);
            $('#ktp').val(ktp);
            $('#modal-item').modal('hide');
        })

        // konversi real-time ke number_format dan regex
        $('#jumlah_txt').keyup(function() {
            var jumlah = $(this).val();

            $('#jumlah').val(jumlah.replace(/\,/g, '', ));
            $('#jumlah_txt').val(number_format(jumlah));
        });

        $('#penarikan_add').on('click', function(e) {
            if ($('#nama_karyawan').val() == '') {
                alert('Karyawan Belum Dipilih');
                e.preventDefault();
            }
            if ($('#nama_kuasa').val() != '') {
                if ($('#identitas_kuasa').val() == '') {
                    alert('No Identitas Penyetor Belum Diisi');
                    e.preventDefault();
                } else if ($('#alamat_kuasa').val() == '') {
                    alert('Alamat Penyetor Belum Diisi');
                    e.preventDefault();
                }
            }
        })
    })
</script>