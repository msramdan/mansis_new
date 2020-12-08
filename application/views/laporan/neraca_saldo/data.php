<tr rowspan="2">
    <td colspan='5'>
        <strong><?= 'Aktiva Lancar' ?></strong>
    </td>
</tr>
<?php
$saldo_debet = 0;
$saldo_kredit = 0;
$saldo = 0;
if (!empty($get_laporan)) {
    foreach ($get_laporan['jenis_kas'] as $k => $value) {
        $saldo_kas = $this->lap_neraca_saldo_m->get_saldo_kas($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();
        $saldo_debet += $saldo_kas->jumlah_debet;
        $saldo_kredit += $saldo_kas->jumlah_kredit;
        $sub_total = $saldo_kas->jumlah_debet - $saldo_kas->jumlah_kredit;
        $saldo += $sub_total;
?>
        <tr>
            <td class="text-center">
                <?= $k + 1; ?>
            </td>
            <td class="text-center">
                <?= $value->nama ?>
            </td>
            <td class="text-center">
                <?= rupiah($saldo_kas->jumlah_debet) ?>
            </td>
            <td class="text-center">
                <?= rupiah($saldo_kas->jumlah_kredit) ?>
            </td>
            <td class="text-center">
                <?= rupiah($sub_total) ?>
            </td>
        </tr>
    <?php
    }
    $no = $k;
    ?>
    <?php foreach ($get_laporan['jenis_akun'] as $k => $value) {
        $saldo_akun = $this->lap_neraca_saldo_m->get_saldo_akun($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();
        $saldo_debet += $saldo_akun->jumlah_debet;
        $saldo_kredit += $saldo_akun->jumlah_kredit;
        $sub_total = $saldo_akun->jumlah_debet - $saldo_akun->jumlah_kredit;
        $saldo += $sub_total;

        if (strlen($value->kd_aktiva) != 1) {
    ?>
            <tr>
                <td class="text-center">
                    <?= $no++; ?>
                </td>
                <td class="text-center">
                    <?= $value->jns_trans ?>
                </td>
                <td class="text-center">
                    <?= rupiah($saldo_akun->jumlah_debet) ?>
                </td>
                <td class="text-center">
                    <?= rupiah($saldo_akun->jumlah_kredit) ?>
                </td>
                <td class="text-center">
                    <?= rupiah($sub_total) ?>
                </td>
            </tr>
        <?php
        } else {
            $no = 1; ?>
            <tr rowspan="2">
                <td colspan='5'>
                    <strong><?= $value->jns_trans; ?></strong>
                </td>
            </tr>
    <?php   }
    }
    ?>
    <tr>
        <td colspan="2" class="text-center">
            <strong>Total</strong>
        </td>
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
<?php
}
?>