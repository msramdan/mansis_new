<section class="content-header">
    <h1>Pengeluaran
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaksi Kas</li>
        <li class="active">Pengeluaran</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add Pengeluaran</h3>
            <div class="pull-right">
                <a href="<?= site_url('kas/pengeluaran') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i>Back
                </a>
            </div>
        </div>
        <div class="box-body ">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('kas/process') ?>" method="post">
                        <div class="form-group ">
                            <label>Date*</label>
                            <input type="date" name="date" value="<?= date('Y-m-d') ?>" class="form-control " required>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="jumlah">Jumlah*</label>
                                <input type="hidden" name="jumlah" class="form-control" id="jumlah" required>
                                <input type="text" name="jumlah_txt" class="form-control" id="jumlah_txt" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="jns_kas">Dari Kas*</label>
                            <select name="jns_kas" class="form-control" required>
                                <option value="">-- Pilih -- </option>
                                <?php foreach ($jns_kas as $key => $data) {
                                    echo '<option value="' . $data->id . '">' . $data->nama . '</option>';
                                } ?>
                            </select>
                        </div>

                        <div class="form-group ">
                            <label for="jns_akun">Untuk Akun*</label>
                            <select name="jns_akun" class="form-control" required>
                                <option value="">-- Pilih -- </option>
                                <?php foreach ($jns_akun as $key => $data) {
                                    echo '<option value="' . $data->id . '">' . $data->jns_trans . '</option>';
                                } ?>
                            </select>
                        </div>

                        <?php if ($this->session->userdata('level') == 1) { ?>
                            <div class="form-group ">
                                <label for="perusahaan">Perusahaan*</label>
                                <select name="perusahaan" class="form-control" required>
                                    <option value="">-- Pilih -- </option>
                                    <?php foreach ($perusahaan as $key => $data) {
                                        echo '<option value="' . $data->perusahaan_id . '">' . $data->name . '</option>';
                                    } ?>
                                </select>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <button type="submit" name="pengeluaran_add" id="pengeluaran_add" class="btn btn-success btn"><i class="fa fa-paper-plane"></i>Save</button>
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

<script>
    $(document).ready(function() {
        // konversi real-time ke number_format dan regex
        $('#jumlah_txt').keyup(function() {
            var jumlah = $(this).val();

            $('#jumlah').val(jumlah.replace(/\,/g, '', ));
            $('#jumlah_txt').val(number_format(jumlah));
        });

    })
</script>