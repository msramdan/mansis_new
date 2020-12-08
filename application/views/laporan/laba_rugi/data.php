<tr rowspan="2">
    <td colspan='5'>
        <strong><?= 'Pendapatan' ?></strong>
    </td>
</tr>
<?php
$saldo_debet = 0;
$saldo_kredit = 0;
$saldo = 0;

$saldo_pendapatan = 0;
$saldo_kredit_pendapatan = 0;
$saldo_debet_pendapatan = 0;
if (!empty($get_laporan)) {
    foreach ($get_laporan['akun_pendapatan'] as $k => $value) {
        $saldo_akun = $this->lap_laba_rugi_m->get_saldo_akun($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();
        $value->debet = $saldo_akun->jumlah_debet;
        $saldo_debet_pendapatan += $value->debet;
        $saldo_debet += $saldo_debet_pendapatan;

        $value->kredit = $saldo_akun->jumlah_kredit;
        $saldo_kredit_pendapatan += $value->kredit;
        $saldo_kredit += $saldo_kredit_pendapatan;

        $sub_total = $saldo_akun->jumlah_debet - $saldo_akun->jumlah_kredit;
        $saldo_pendapatan += $sub_total;
        $saldo += $sub_total;

        if (strlen($value->kd_aktiva) != 1) {
?>
            <tr>
                <td class="text-center">
                    <?= $k; ?>
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
        }
    } ?>
    <tr>
        <td colspan="2" class="text-center">
            <strong>Total Pendapatan</strong>
        </td>
        <td class="text-center">
            <strong><?= rupiah($saldo_debet_pendapatan) ?></strong>
        </td>
        <td class="text-center">
            <strong><?= rupiah($saldo_kredit_pendapatan) ?></strong>
        </td>
        <td class="text-center">
            <strong><?= rupiah($saldo_pendapatan) ?></strong>
        </td>
    </tr>
    <tr rowspan="2">
        <td colspan='5'>
            <strong><?= 'Biaya' ?></strong>
        </td>
    </tr>
    <?php
    $saldo_pendapatan = 0;
    $saldo_kredit_pendapatan = 0;
    $saldo_debet_pendapatan = 0;

    foreach ($get_laporan['akun_biaya'] as $k => $value) {
        $saldo_akun = $this->lap_laba_rugi_m->get_saldo_akun($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();
        $value->debet = $saldo_akun->jumlah_debet;
        $saldo_debet_biaya += $value->debet;
        $saldo_debet += $saldo_debet_biaya;

        $value->kredit = $saldo_akun->jumlah_kredit;
        $saldo_kredit_biaya += $value->kredit;
        $saldo_kredit += $saldo_kredit_biaya;

        $sub_total = $saldo_akun->jumlah_debet - $saldo_akun->jumlah_kredit;
        $saldo_biaya += $sub_total;
        $saldo += $sub_total;

        if (strlen($value->kd_aktiva) != 1) {
    ?>
            <tr>
                <td class="text-center">
                    <?= $k + 1; ?>
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
        }
    }
    ?>
    <tr>
        <td colspan="2" class="text-center">
            <strong>Total Biaya</strong>
        </td>
        <td class="text-center">
            <strong><?= rupiah($saldo_debet_biaya) ?></strong>
        </td>
        <td class="text-center">
            <strong><?= rupiah($saldo_kredit_biaya) ?></strong>
        </td>
        <td class="text-center">
            <strong><?= rupiah($saldo_biaya) ?></strong>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <strong>Total Laba Rugi</strong>
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