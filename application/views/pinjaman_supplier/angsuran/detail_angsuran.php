<?php
$sisa_tagihan = $detail->jumlah - $detail->jumlah_bayar;
?>

<section class="content-header">
    <h1>Data Angsuran Supplier
        <small>Data Angsuran Supplier</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Angsuran Supplier</li>
    </ol>
</section>

<section class="content">
    <?php $this->view('messages') ?>
    <div class="card">
        <div class="box box-solid box-primary">
            <div class="box-header" title="Detail Pinjaman" data-toggle="" data-original-title="Detail Pinjaman">
                <h3 class="box-title"> Detail Pinjaman </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body" style="padding:5px;">
                <table style="font-size: 17px; width:100%">
                    <tr>
                        <td>
                            <table style="width:100%">
                                <tr>
                                    <td><label class="text-green">Data Supplier</label></td>
                                </tr>
                                <tr>
                                    <td> Nama Supplier </td>
                                    <td> : </td>
                                    <td> <?php echo $detail->nama_supplier; ?></td>
                                </tr>
                                <tr>
                                    <td> Nama Barang </td>
                                    <td> : </td>
                                    <td> <?php echo $detail->nama_item; ?></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="width:100%">
                                <tr>
                                    <td><label class="text-green">Data Pinjaman</label></td>
                                </tr>
                                <tr>
                                    <td> Kode Pinjam</td>
                                    <td> : </td>
                                    <td> <?php echo 'PJ' . sprintf('%05d', $detail->pinjaman_id) . '' ?> </td>
                                </tr>
                                <tr>
                                    <td> Tanggal Pinjam</td>
                                    <td> : </td>
                                    <td> <?php
                                            echo date('Y-m-d', strtotime($detail->tgl_pinjam));
                                            ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Pokok Pinjaman</td>
                                    <td> : </td>
                                    <td class="h_kanan"> <?php echo rupiah($detail->jumlah); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="box box-solid box-primary">
            <div class="box-header bg-light-blue" title="Detail Pinjaman" data-toggle="" data-original-title="Detail Pinjaman">
                <h3 class="box-title"><strong> Rangkuman </strong> &raquo; </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body" style="padding:5px; font-weight:bold;">
                <table width="100%" style="font-size: 20px;">
                    <tr>
                        <td> Dibayar : <span id="det_sudah_bayar"> <?php echo rupiah($detail->jumlah_bayar); ?></span> </td>
                        <td> Denda : <span id="det_jml_denda"> <?php echo rupiah($detail->denda); ?> </span> </td>
                        <td> Sisa Tagihan : <span id="total_bayar"> <?php echo rupiah($sisa_tagihan); ?> </span> </td>
                        <td> Status Pelunasan : <span id="ket_lunas"> <?php echo $detail->status_lunas; ?> </span> </td>
                        </code>
                    </tr>
                </table>
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Pembayaran Angsuran</strong></h3>
                <div class="pull-right">
                    <?php if ($detail->status_lunas != 'Tidak Aktif') { ?>
                        <button class="btn btn-primary btn-flat" id="tambah-pembayaran" data-toggle="modal" data-target="#modal-form" data-pinjaman_id="<?= $detail->pinjaman_id ?>" data-sisa_tagihan="<?= $sisa_tagihan ?>">
                            <i class="fa fa-plus"></i> Tambah Pembayaran
                        </button>
                    <?php } ?>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Angsuran Ke</th>
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
                        $angsuran_ke = count($row->result());
                        foreach ($row->result() as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $angsuran_ke-- ?></td>
                                <td><?= $value->tgl_bayar ?> </td>
                                <td><?= rupiah($value->jumlah_bayar) ?></td>
                                <td><?= ($value->denda == '') ? 0 : $value->denda ?></td>
                                <td><?= $value->keterangan ?></td>
                                <td><?= $value->status_angsuran ?></td>
                                <td><a id="cek_bukti" href="javascript:void(0)" data-path="<?= base_url('assets/uploads/bukti_angsuran/') . $value->photo_bukti ?>" class="btn btn-primary" onclick="buka_bukti('<?= base_url('assets/uploads/bukti_angsuran/') . $value->photo_bukti ?>')" style="cursor: pointer;">Cek Bukti</a></td>
                                <td><?php if ($value->status_angsuran == 'Menunggu Konfirmasi') {
                                        echo '<button id="button-hapus" class="btn btn-danger" data-pinjaman_id="' . $detail->pinjaman_id . '"data-angsuran_id="' . $value->angsuran_id . '" data-toggle="modal" data-target="#modal-hapus">Hapus</button>';
                                    } ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>

                </table>

            </div>

        </div>

        <div class="modal fade" id="modal-form">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" arial-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3>Tambah Pembayaran</h3>
                    </div>
                    <div class="modal-body">
                        <form action="<?= site_url('pinjaman_supplier/angsuran/process') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="pinjaman_id" id="pinjaman_id" class="form-control">
                            <div class="form-group " id="tgl_bayar_grup">
                                <label>Tanggal Bayar*</label>
                                <input type="date" name="tgl_bayar" value="<?= date('Y-m-d') ?>" class="form-control ">
                            </div>
                            <div class="form-group ">
                                <label for="jumlah_bayar_txt">Nominal Pembayaran*</label>
                                <input type="hidden" name="jumlah_bayar" id="jumlah_bayar" class="form-control">
                                <input type="text" name="jumlah_bayar_txt" id="jumlah_bayar_txt" class="form-control" required>
                            </div>
                            <div class="form-group ">
                                <label for="sisa_tagihan">Sisa Tagihan*</label>
                                <input type="hidden" name="sisa_tagihan" id="sisa_tagihan" class="form-control">
                                <input type="text" name="sisa_tagihan_txt" id="sisa_tagihan_txt" class="form-control" readonly>
                            </div>
                            <div class="form-group " id="photo_bukti_grup">
                                <label for="a">Bukti Foto*</label>
                                <input type="file" name="photo_bukti" id="photo_bukti" class="form-control" required>
                            </div>
                            <div class="form-group " id="keterangan_grup">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control ">
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" id="submit" name="add_angsuran" class="btn btn-success"><i class="fa fa-paper-plane"></i> Yes</button>
                                <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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

        <div class="modal fade" id="modal-hapus">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" arial-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3>Yakin Hapus Angsuran?</h3>
                    </div>
                    <div class="modal-body">
                        <form action="<?= site_url('pinjaman_supplier/angsuran/process') ?>" method="post">
                            <input type="hidden" name="pinjaman_id_2" id="pinjaman_id_2" class="form-control">
                            <input type="hidden" name="angsuran_id" id="angsuran_id" class="form-control">
                            <div class="form-group ">
                                <label for="status">Status*</label>
                                <input type="text" name="status" id="status" class="form-control" value="Hapus" readonly>
                            </div>
                            <button type="submit" id="submit_hapus" name="hapus" class="btn btn-success"><i class="fa fa-paper-plane"></i> Yes</button>
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

        $(document).on('click', '#tambah-pembayaran', function() {
            var pinjaman_id = $(this).data('pinjaman_id');
            var sisa_tagihan = $(this).data('sisa_tagihan');

            if (sisa_tagihan <= 0) {
                $('#modal-form').modal('hide');
                alert('Pembayaran Sudah Lunas');
            }

            $('#pinjaman_id').val(pinjaman_id);
            $('#sisa_tagihan_txt').val(number_format(sisa_tagihan));
            let total;

            $('#jumlah_bayar_txt').keyup(function() {
                var jumlah_txt = $(this).val();

                $('#jumlah_bayar').val(jumlah_txt.replace(/\,/g, '', ));
                $('#jumlah_bayar_txt').val(number_format(jumlah_txt));

                var jumlah = $('#jumlah_bayar').val();
                total = parseFloat(sisa_tagihan - jumlah);

                $('#sisa_tagihan_txt').val(number_format(total));
                $('#sisa_tagihan').val(total);
            });

            $('#submit').on('click', function(e) {
                if (total < 0) {
                    alert('Pembayaran Melebihi Sisa Tagihan');
                    e.preventDefault();
                }
            })
        })

        $(document).on('click', '#button-hapus', function() {
            var angsuran_id = $(this).data('angsuran_id');
            var pinjaman_id = $(this).data('pinjaman_id');
            $('#angsuran_id').val(angsuran_id);
            $('#pinjaman_id_2').val(pinjaman_id);
        })
    })
</script>