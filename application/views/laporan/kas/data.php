<?php
$saldo_debet = 0;
$saldo_kredit = 0;
$saldo = 0;
if (!empty($get_laporan)) {
    foreach ($get_laporan['transaksi_kas'] as $k => $value) {
        if ($value->tbl == 'simpanan') {
            $jenis_akun = $this->lap_kas_m->get_jenis_simpanan($value->transaksi)->row();
            if (isset($jenis_akun)) {
                $value->jenis_akun_nama = $jenis_akun->ket;
            }
        } else {
            $jenis_akun = $this->lap_kas_m->get_jenis_akun($value->transaksi)->row();
            if (isset($jenis_akun)) {
                $value->jenis_akun_nama = $jenis_akun->jns_trans;
            }
        }
        if (!isset($value->jenis_akun_nama)) {
            $value->jenis_akun_nama = '';
        }

        $dari_kas = $this->lap_kas_m->get_jenis_kas($value->dari_kas)->row();
        $untuk_kas = $this->lap_kas_m->get_jenis_kas($value->untuk_kas)->row();

        if (isset($dari_kas)) {
            $value->dari_kas_nama = $dari_kas->nama;
        } else {
            $value->dari_kas_nama = '';
        }
        if (isset($untuk_kas)) {
            $value->untuk_kas_nama = $untuk_kas->nama;
        } else {
            $value->untuk_kas_nama = '';
        }

        $saldo_debet += $value->debet;
        $saldo_kredit += $value->kredit;
        $sub_total = $value->debet - $value->kredit;
        $saldo += $sub_total;
?>

        <tr>
            <td class="text-center">
                <?= $k + 1; ?>
            </td>
            <td class="text-center">
                <?= date('Y-m-d', strtotime($value->tgl)) ?>
            </td>
            <td class="text-center">
                <?= $value->jenis_akun_nama; ?>
            </td>
            <td class="text-center">
                <?= $value->dari_kas_nama; ?>
            </td>
            <td class="text-center">
                <?= $value->untuk_kas_nama; ?>
            </td>
            <td class="text-center">
                <?= rupiah($value->debet); ?>
            </td>
            <td class="text-center">
                <?= rupiah($value->kredit); ?>
            </td>
            <td class="text-center">
                <?= rupiah($sub_total); ?>
            </td>
        </tr>
    <?php
    } ?>
    <tr>
        <td colspan="5" class="text-center">
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
    <tr>
        <td colspan="5" class="text-center">
            <strong>Selisih Balance</strong>
        </td>
        <td colspan="3" class="text-center">
            <strong><?= rupiah($saldo_debet - $saldo_kredit) ?></strong>
        </td>
    </tr>
<?php
}
?>