<!DOCTYPE html>
<html>
<head>
	<title>Cetak Nota</title>
</head>
<body onload="window.print()">

<div style="width: 250px" class="conten">
		<div style="width: 250px">
		<small style="text-align: center;display: inline-block;margin-bottom: 5px;">JL. Wonosari-Panggang, Km 22 Saptosari Gunungkidul, Kepek, Sapto Sari, Kabupaten Gunung Kidul, YK</small>
		<br>

	</div>
 	<table width="250px;">
 		<tr>
 			<td>Tanggal</td>
 			<td class="right"><?=date_indo($bio->tanggal); ?></td>
 		</tr>
 		<tr>
 			<td>Nomor</td>
 			<td class="right"><?=sprintf("%05d",$bio->id_customer) ?></td>
 		</tr>
 		<tr>
 			<td>Pelanggan</td>
 			<td class="right"><?=$bio->nama ?></td>
 		</tr>
 		<tr>
 			<td>Petugas</td>
 			<td class="right">admin</td>
 		</tr>
 	</table>
 	
 	<table width="250px;">
 		<tr>
 			<td colspan="3" style="border-bottom: 2px solid black"></td>
 		</tr>
 		<tr >
 			<th>Barang</th>
 			<th>QTY</th>
 			<th>Harga</th>
 		</tr>
 		<tr>
 			<td colspan="3" style="border-bottom: 2px solid black"></td>
 		</tr>
 		<?php 
 			$total = 0;
 			$qty = 0;
 			foreach($item as $row){
 		 ?>
 		<tr>
 			<td colspan="3" style="border-bottom: 1px dashed black"></td>
 		</tr>
 		<tr>
 			<td><?=$row->nama_barang ?></td>
 			<td><?=$row->qty ?></td>
 			<td><?php
 				$item = $row->price * $row->qty;
 				echo number_format($item,1,",",".");
 			?>
 				
 			</td>
 		</tr>
 		<tr>
 			<td colspan="3" style="border-bottom: 1px dashed black"></td>
 		</tr>
 		<?php 
 		$qty += $row->qty;
 		$total += $item 
 		?>
 	<?php } ?>
 	<tr>
 			<td colspan="3" style="border-bottom: 2px solid black"></td>
 		</tr>
 	</table>
 	<br>
 	<table width="250">
 		<tr>
 			<td><b>ITEM</b></td>
 			<td class="right"><b><?=$qty; ?></b></td>
 		</tr>
 		<tr>
 			<td><b>TOTAL</b></td>
 			<td class="right"><b><?='Rp. '.number_format($total, 1, ",", ".") ?></b></td>
 		</tr>
 	</table>
</div>
</body>
<style type="text/css">
	.conten{
		margin: 0 auto;
	}
	table tr .right{
		text-align: right;
	}
	table tr td{
		font-size: 11pt;
	}
	table tr th{
		text-align: center;
	}

	body{
		font-family: sans-serif;
	}
</style>
</html>