<?php
$saldo_setoran = 0;
$saldo_penarikan = 0;
$saldo = 0;
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