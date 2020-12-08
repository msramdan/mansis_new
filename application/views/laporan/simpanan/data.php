<?php
$saldo_setoran = 0;
$saldo_penarikan = 0;
$saldo = 0;
if (!empty($get_laporan)) {
    foreach ($get_laporan['jenis_simpanan'] as $k => $value) {
        $simpanan = $this->lap_simpanan_m->get_simpanan($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();

        // pakai where di sini
        $saldo_setoran += $simpanan->jumlah_setoran;
        $saldo_penarikan += $simpanan->jumlah_penarikan;
        $sub_total = $simpanan->jumlah_setoran - $simpanan->jumlah_penarikan;
        $saldo += $sub_total;
?>
        <tr>
            <td class="text-center">
                <?= $k + 1; ?>
            </td>
            <td class="text-center">
                <?= $value->ket ?>
            </td>
            <td class="text-center">
                <?= rupiah($simpanan->jumlah_setoran) ?>
            </td>
            <td class="text-center">
                <?= rupiah($simpanan->jumlah_penarikan) ?>
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
            <strong><?= rupiah($saldo_setoran) ?></strong>
        </td>
        <td class="text-center">
            <strong><?= rupiah($saldo_penarikan) ?></strong>
        </td>
        <td class="text-center">
            <strong><?= rupiah($saldo) ?></strong>
        </td>
    </tr>
<?php
}
?>