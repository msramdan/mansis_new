
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji <?=$karyawan->nama_perusahaan ?> </title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 10px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 10px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body onload="window.print()">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0" border="1">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="width: 65%">
                                <b style="font-size: 28px"><?=$karyawan->nama_perusahaan ?></b><br>
                            </td>
                        </tr>
                    </table>
                    <center><b>SLIP GAJI</b><br>
                        Bulan : November 2020
                    </center>
                    
                    
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table style="line-height: 8px; width: 300px">
                        <tr>
                            <td>NIK
                            </td>
                            <td>:</td>
                            <td><?=$karyawan->kd_karyawan ?></td>
                        </tr>
                        <tr>
                            <td>Nama Karyawan
                            </td>
                            <td>:</td>
                            <td><?=$karyawan->name ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan
                            </td>
                            <td>:</td>
                            <td><?=$karyawan->nama_jabatan ?></td>
                        </tr>
                        <tr>
                            <td>Total Jam Kerja
                            </td>
                            <td>:</td>
                            <td><?=$lama_kerja ?> Jam</td>
                        </tr>
                    </table>





                    <table border="1" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr style="text-align: center;">
                                <th style="width: 50%">PERINCIAN PENGHASILAN</th>
                                <th style="width: 50%">PERINCIAN POTONGAN</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <table style="line-height: 8px; width: 100%">
                                    <tr>
                                        <td>Upah</td>
                                        <td><?php echo rupiah($lama_kerja*$karyawan->rate_gaji) ?></td>
                                    </tr>
                                    <?php
                                    $jumlah_tambahan =0;
                                        foreach ($tambahan as $key => $value) {
                                        $jumlah_tambahan=$jumlah_tambahan + $value->besar_tambahan; ?>
                                            <tr>
                                                <td><?=$value->nama_benefit ?></td>
                                                <td><?=rupiah($value->besar_tambahan) ?></td>
                                            </tr>
                                    <?php } ?>
                                </table>      
                            </td>
                            <td>
                                <table style="line-height: 8px; width: 100%">
                                    <tr>
                                        <td>Kasbon</td>
                                        <td><?php echo rupiah($kasbon) ?></td>
                                    </tr>
                                    <?php
                                    $jumlah_potongan =0;
                                        foreach ($potongan as $key => $value) {
                                            $jumlah_potongan=$jumlah_potongan + $value->besar_potongan;
                                         ?>
                                            <tr>
                                                <td><?=$value->nama_categoripotongan ?></td>
                                                <td><?=rupiah($value->besar_potongan) ?></td>
                                            </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>
                    <tr>
                        <td>
                            <table style="line-height: 8px; width: 100%">
                                    <tr>
                                        <td>JUMLAH KOTOR</td>
                                        <td><?php echo rupiah($jumlah_tambahan + ($lama_kerja*$karyawan->rate_gaji)) ?></td>
                                    </tr>
                                </table> 
                        <td>
                            <table style="line-height: 8px; width: 100%">
                                    <tr>
                                        <td>JUMLAH POTONGAN</td>
                                        <td><?php echo rupiah($jumlah_potongan + $kasbon)?></td>
                                    </tr>
                                </table> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="line-height: 8px; width: 100%">
                                    <tr>
                                        <td>JUMLAH BERSIH</td>
                                        <td><?php echo rupiah(($jumlah_tambahan + ($lama_kerja*$karyawan->rate_gaji)) - ($jumlah_potongan + $kasbon) ) ?></td>
                                    </tr>
                                </table> 
                        </td>
                    </tr>
                </table><br>
                * Dokumen ini dicetak secara komputerisasi dan bersifat sah tanpa tanda tangan

    </div>
</body>
</html>
