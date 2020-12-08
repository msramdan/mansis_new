
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Faktur Invoice Salwa Toko</title>
    
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
                    <table border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width: 65%">
                                <b style="font-size: 28px">FAKTUR PENJUALAN</b><br>
                                <b>TOKO SALWA</b><br>
                                <b>Supplier Hasil Bumi dan Sembako</b>
                            </td>
                            <td>
                                No.Faktur #: <?=$sale->invoice ?><br>
                                Tanggal: <?php echo Date("d/m/Y", strtotime($sale->date)); ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="text-align: left;width: 65%">
                                Pasar Taman Wisma Asri<br>
                                Jl. Markisa I Blok D17/N0.1, Bekasi Utara<br>
                                0813 1036 6636
                            </td>
                            
                            <td style="text-align: left">
                                Cashier : <?php echo ucfirst($sale->user_name) ?><br>
                                Nama : <?=$sale->customer_id == null ? "Umum" : $sale->customer_name ?><br>
                               <!--  Pasar : <?php echo ucfirst($sale->name_pasar) ?><br> -->
                            </td>
                        </tr>
                    </table>
                    <table border="1" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Discount / Item</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <?php
                            $arr_discount = array();
                            foreach ($sale_detail as $key => $value) { ?>
                                <tr>
                                    <td><?=$value->name_item ?></td>
                                    <td><?=$value->qty ?></td>
                                    <td><?=$value->name_unit ?></td>
                                    <td><?=rupiah($value->price) ?></td>
                                    <td><?=rupiah($value->discount_item) ?></td>
                                    <td ">
                                        <?=rupiah(($value->price - $value->discount_item)*$value->qty) ?>
                                    </td>
                                </tr>
                           
                            <?php } ?>
                    <tr>
                        <td>Grand Total</td>
                        <td colspan="5">
                            <?=rupiah($sale->final_price )?>
                        </td>
                    </tr>
                    <tr>
                        <td>Cash</td>
                        <td colspan="5">
                            <?=rupiah($sale->cash) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Kembalian</td>
                        <td colspan="5"><?=rupiah($sale->remaining) ?></td>
                    </tr>
               <!--      <tr style="text-align: left;">
                        <td>Note</td>
                        <td colspan="5" style="text-align: left;"><?=$sale->note ?></td>
                    </tr> -->
                    </table>

    </div>
</body>
</html>
