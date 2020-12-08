<section class="content-header">
    <h1>Laporan
        <small>List Laporan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Buku Besar</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header" title="Detail Buku Besar" data-toggle="" data-original-title="Detail Buku Besar">
            <h3 class="box-title"> <strong>Laporan Buku Besar</strong> </h3>
            <div class="box-tools pull-right">
                <button class="btn btn-primary btn-xs" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <form>
                <!-- <input type="hidden" name="tipe" value="<?php print $tipe ?>"> -->
                <div class="d-flex justify-content-between" style="font-size: 17px;">
                    <div style="display: inline-block; width:20%; margin: 0px 5px;" class="form-group">
                        <label for="tanggal" class="control-label">Tanggal Awal</label>
                        <input type="month" class="form-control" name="tanggal_awal" value="<?= date('Y-m') ?>" required />
                    </div>
                    <div style="width:20%; display: inline-block; margin: 0px 5px;" class="form-group">
                        <button class="btn btn-primary btn-tampil-laporan" data-link="<?= base_url('laporan/lap_buku_besar/process/') ?>">Tampilkan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="box">
        <div class="box-header" title="Detail Buku Besar" data-toggle="" data-original-title="Detail Buku Besar">
            <h3 class="box-title"> <strong>Laporan Buku Besar</strong> <strong><span id="tanggal_awal"></span> <span id="tanggal_akhir"></span></strong> </h3>
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
                <div class="data-list-laporan"></div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#cetak_laporan').hide();
        $(document).on('click', '.btn-tampil-laporan', function(e) {
            $('.btn-tampil-laporan').text('Proses...');
            $('.btn-tampil-laporan').attr('disabled', true);

            var link = $(this).data('link');
            // var form = $('.form').serialize();
            var data = new FormData(this.form);
            var tanggal_awal = $('input[name=tanggal_awal]').val();

            $.ajax({
                    url: link,
                    type: 'POST',
                    async: true,
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                })
                .done(function(data) {
                    if (tanggal_awal == '') {
                        alert('Anda Belum Memilih Tanggal');
                    } else {
                        $('#cetak_laporan').show();
                        $('#cetak_laporan').attr('href', '<?= base_url('laporan/lap_buku_besar/cetak/') ?>' + tanggal_awal);
                        $('#tanggal_awal').text('Periode: ' + tanggal_awal);
                        $('.btn-to-cetak-kasir').show();
                        $('.data-list-laporan').html(data);

                    }

                    $('.btn-tampil-laporan').text('Tampilkan Data');
                    $('.btn-tampil-laporan').attr('disabled', false);
                })
        });
    })
</script>