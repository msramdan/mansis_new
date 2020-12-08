
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pekerjaan  </title>
    
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
                                <b style="font-size: 28px"><?=$raker->nama_perusahaan ?></b><br>
                            </td>
                        </tr>
                    </table>

                    <center><b>LAPORAN PEKERJAAN</b><br>
                    </center>
                    
                    
                </td>
            </tr>
            
            <tr class="information">
                <td>
                    <table>
                        <tr>
                            <td>NIK
                            </td>
                            <td>:</td>
                            <td><?=$raker->kd_karyawan ?></td>
                        </tr>
                        <tr>
                            <td>Nama Karyawan
                            </td>
                            <td>:</td>
                            <td><?=$raker->nama_karyawan ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan
                            </td>
                            <td>:</td>
                            <td><?=$raker->nama_jabatan ?></td>
                        </tr>
                        <tr>
                            <td>Status Pekerjaan
                            </td>
                            <td>:</td>
                            <td><?=$raker->status ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai
                            </td>
                            <td>:</td>
                            <td><?=$raker->tgl_mulai ?></td>
                        </tr>

                        <?php if ($raker->status=='Complate') { ?>
                        <tr>
                            <td>Tanggal Selesai
                            </td>
                            <td>:</td>
                            <td><?=$raker->tgl_selesai ?></td>
                        </tr>
                        <?php }else{ ?>
                        <tr>
                            <td>Tanggal Selesai
                            </td>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Jobdesk
                            </td>
                            <td>:</td>
                            <td><?=$raker->title ?></td>
                        </tr>
                        <tr>
                            <td>Rencana Kerja
                            </td>
                            <td>:</td>
                            <td style="text-align: justify;"><?=$raker->desk ?></td>
                        </tr>
                        <table border="1">
                            <tr>
                            <td style="text-align: justify;height: 100px"><b>Evaluasi :</b><br><?=$raker->note ?></td>
                        </tr>
                            
                        </table>
                        <table border="1">
                            <tr>
                            <td style="text-align: justify;height: 100px"><b>Solusi :</b><br><?=$raker->solusi ?></td>
                        </tr>
                            
                        </table>
                    </table>
                </td>
            </tr>



                </table><br>
                * Dokumen ini dicetak secara komputerisasi dan bersifat sah tanpa tanda tangan

    </div>
</body>
</html>
