<?php
$saldo_debet = 0;
$saldo_kredit = 0;
$saldo = 0;
if (!empty($get_laporan)) {
    foreach ($get_laporan['jenis_kas'] as $k => $value) {
        $saldo_kas = $this->lap_saldo_kas_m->get_saldo_kas($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();
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