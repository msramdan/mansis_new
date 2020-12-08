<!DOCTYPE html>
<html>
<head>
	<title>Salwa Toko - Print Nota</title>
	<style type="text/css">
		html { font-family: "verdana, Arial"; }
		.content{
			width: 80mm;
			font-size: 12px;
			padding: 5px;
		}
		.title{
			text-align: center;
			font-size: 13px;
			padding-bottom: 5px;
			border-bottom: 1px dashed;
		}
		.head{
			margin-top: 5px;
			margin-bottom: 10px;
			padding-bottom: 10px;
			border-bottom: 1px solid;
		}

		table{
			width: 100%;
			font-size: 12px;
		}

		.thanks{
			margin-top: 10px;
			padding-top: 10px;
			text-align: center;
			border-top: 1px dashed;
		}
		@media print{
			@page{
				width: 80mm;
				margin: 0mm;
			}
		}

	</style>
</head>
<body onload="window.print()">
	<div class="content">
		<div class="title">
			<b>Salwa Toko</b>
			<br>
			Jln Dewi Sartika No 25
		</div>
		<div class="head">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td style="width: 200px">
						<?php echo Date("d/m/Y", strtotime($sale->date)).''.Date("H:i", strtotime($sale->sale_created)); ?>
					</td>
					<td>Cashier</td>
					<td style="text-align: center;width: 10px">:</td>
					<td style="text-align: right;">
						<?php echo ucfirst($sale->user_name) ?>
					</td>
				</tr>
				<tr>
					<td>
						<?=$sale->invoice ?>
					</td>
					<td>Customer</td>
					<td style="text-align: center;">:</td>
					<td style="text-align: right;">
						<?=$sale->customer_id == null ? "Umum" : $sale->customer_name ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="transaction">
			<table class="transaction-table" cellspacing="0" cellpadding="0">
				<?php
				$arr_discount = array();
				foreach ($sale_detail as $key => $value) { ?>
					<tr>
						<td style="width: 165px"><?=$value->name ?></td>
						<td><?=$value->qty ?></td>
						<td style="text-align: right;width: 60px"><?=rupiah($value->price) ?></td>
						<td style="text-align: right;width: 60px">
							<?=rupiah(($value->price - $value->discount_item)*$value->qty) ?>
						</td>
					</tr>
					<?php
					if ($value->discount_item >0) {
						$arr_discount[] = $value->discount_item;
					}
				}
				foreach ($arr_discount as $key => $value) { ?>
					<tr>
						<td></td>
						<td colspan="2" style="text-align: right;">Disc. <?=($key+1) ?></td>
						<td style="text-align: right;"><?=rupiah($value) ?></td>
					</tr>
				<?php } ?>


				<tr>
					<td colspan="4" style="border-bottom: 1px dashed; padding-top: 5px"></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="text-align: right;padding-top: 5px"> Sub Total</td>
					<td style="text-align: right; padding-top: 5px">
						<?=rupiah($sale->total_price) ?>
					</td>
				</tr>




				
			<?php if ($sale->discount >0) { ?>
				<tr>
					<td colspan="2"></td>
					<td style="text-align: right;padding-bottom: 5px">Disc. Sale</td>
					<td style="text-align: right;padding-bottom: 5px"><?=rupiah($sale->discount) ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="2"></td>
				<td style="border-top: 1px dashed; text-align: right; padding: 5px 0">Grand Total</td>
				<td style="border-top: 1px dashed; text-align: right;padding: 5px 0">
					<?=$sale->final_price ?>
				</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td style="border-top: 1px dashed; text-align: right; padding-top: 5px">Cash</td>
				<td style="border-top: 1px dashed; text-align: right;padding-top: 5px">
					<?=$sale->cash ?>
				</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td style="text-align: right;">Change</td>
				<td style="text-align: right;"><?=$sale->remaining ?></td>
			</tr>
			</table>
		</div>
		<div class="thanks">
			--- Thank You ---
			<br>
			Salwa Toko
		</div>
	</div>
</body>
</html>