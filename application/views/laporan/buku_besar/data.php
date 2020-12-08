<?php
$saldo_debet = 0;
$saldo_kredit = 0;
$saldo = 0;
if (!empty($get_laporan)) {
    foreach ($get_laporan['jenis_kas'] as $kolom) {
        $transaksi_kas = $this->lap_buku_besar_m->get_transaksi_kas($id, $kolom->id, $tanggal_awal)->result(); ?>
        <h3><strong><?= $kolom->nama ?></strong></h3>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jenis Transaksi</th>
                    <th class="text-center">Debet</th>
                    <th class="text-center">Kredit</th>
                    <th class="text-center">Sub Total</th>
                </tr>
            </thead>
            <?php foreach ($transaksi_kas as $k => $value) {
                if ($value->tbl == 'simpanan') {
                    $jenis_akun = $this->lap_buku_besar_m->get_jenis_simpanan($value->transaksi)->row();
                    if (isset($jenis_akun)) {
                        $value->jenis_akun_nama = $jenis_akun->ket;
                    }
                } else {
                    $jenis_akun = $this->lap_buku_besar_m->get_jenis_akun($value->transaksi)->row();
                    if (isset($jenis_akun)) {
                        $value->jenis_akun_nama = $jenis_akun->jns_trans;
                    }
                }
                if (!isset($value->jenis_akun_nama)) {
                    $value->jenis_akun_nama = '';
                }

                $saldo_debet += $value->debet;
                $saldo_kredit += $value->kredit;
                $sub_total = $value->debet - $value->kredit;
                $saldo += $sub_total;
            ?>
                <tbody>
                    <tr>
                        <td class="text-center">
                            <?= $k + 1; ?>
                        </td>
                        <td class="text-center">
                            <?= date('Y-m-d', strtotime($value->tgl)) ?>
                        </td>
                        <td class="text-center">
                            <?= $value->jenis_akun_nama ?>
                        </td>
                        <td class="text-center">
                            <?= rupiah($value->debet) ?>
                        </td>
                        <td class="text-center">
                            <?= rupiah($value->kredit) ?>
                        </td>
                        <td class="text-center">
                            <?= rupiah($sub_total) ?>
                        </td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    <?php
    } ?>
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th class="text-center">Total Debet</th>
                <th class="text-center">Total Kredit</th>
                <th class="text-center">Total Saldo Kas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">
                    <strong><?= rupiah($saldo_debet) ?></strong>
                </td>
                <td class="text-center">
                    <strong><?= rupiah($saldo_kredit) ?></strong>
                </td>
                <td class="text-center">
                    <strong><?= rupiah($saldo) ?></strong>
                </td>
            </tr>
        </tbody>
    </table>
<?php
}
?>