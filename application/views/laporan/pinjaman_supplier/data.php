<?php
$n = 1;
if (!empty($get_laporan)) {
?>
    <tr>
        <td class="text-center">
            <?= 1; ?>
        </td>
        <td class="text-center">
            <?= 'Jumlah Pinjaman' ?>
        </td>
        <td class="text-center">
            <?= $get_laporan['jumlah_pinjaman']; ?>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <?= 2; ?>
        </td>
        <td class="text-center">
            <?= 'Pokok Pinjaman' ?>
        </td>
        <td class="text-center">
            <?= rupiah($get_laporan['nominal_pinjaman']); ?>
        </td>
    </tr>

    <tr>
        <td class="text-center">
            <?= 3; ?>
        </td>
        <td class="text-center">
            <?= 'Tagihan Denda' ?>
        </td>
        <td class="text-center">
            <?= rupiah(0) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <strong><?= 'Jumlah Tagihan + Denda' ?></strong>
        </td>
        <td class="text-center">
            <strong><?= 'Jumlah' ?></strong>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <?= 'Jumlah Dibayar' ?>
        </td>
        <td class="text-center">
            <?= rupiah($get_laporan['jumlah_bayar']); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <?= 'Sisa Tagihan' ?>
        </td>
        <td class="text-center">
            <?= rupiah($get_laporan['tagihan']); ?>
        </td>
    </tr>
<?php
}
?>