<section class="content-header">
    <h1>Laporan
        <small>List Laporan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Data Karyawan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header" title="Detail Karyawan" data-toggle="" data-original-title="Detail Karyawan">
            <h3 class="box-title"> <strong>Laporan Data Karyawan</strong> </h3>
            <div class="box-tools pull-right">
                <button class="btn btn-primary btn-xs" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group d-flex justify-content-end">
                <a class="btn btn-primary" id="cetak_laporan" target="_blank">Cetak Laporan</a>
            </div>
            <div style="font-size: 17px;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Karyawan</th>
                            <th class="text-center">L/P</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Nama Jabatan</th>
                            <th class="text-center">Nama Status</th>
                            <th class="text-center">Nama Perusahaan</th>
                            <th class="text-center">Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($get_laporan)) {
                            foreach ($get_laporan['karyawan'] as $k => $value) {
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $k + 1; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value->nama_karyawan ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value->jk_kelamin ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value->alamat ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value->phone ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value->nama_jabatan ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value->nama_status ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value->nama_perusahaan ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value->tgl_masuk ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#cetak_laporan').attr('href', '<?= base_url('laporan/lap_karyawan/cetak/') ?>');
    })
</script>