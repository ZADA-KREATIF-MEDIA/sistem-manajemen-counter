<!DOCTYPE html>
<html>
<head>
	<title>Cetak Nota</title>
</head>
<body onload="window.print()">

<div style="width: 450px" class="conten">
		<div style="width: 450px">
		<h4>NOTA PEMBELIAN BARANG</h4>
		<h5>Ambarrukmo Plaza Lt. LG BLOK PMA I Kav.25 Sleman, Yogyakarta</h5>
		<br>

	</div>
 	<table width="450px;">
 		<tr>
 			<td>Tanggal</td>
 			<td class="right"><?= ($detail->tanggal); ?></td>
 		</tr>
 		<tr>
 			<td>Nomor</td>
 			<td class="right"><?=sprintf("%05d",$detail->id_customer) ?></td>
 		</tr>
 		<tr>
 			<td>Pelanggan</td>
 			<td class="right"><?=$detail->nama ?></td>
 		</tr>
 		<tr>
 			<td>Petugas</td>
 			<td class="right"><?php echo $this->session->userdata('username') ?></td>
 		</tr>
 	</table>
 	
 	<table width="450px;">
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
 	
 		<tr>
 			<td colspan="3" style="border-bottom: 1px dashed black"></td>
 		</tr>
 		<tr align='center'>
             <td><?=$detail->nama_barang ?></td>
             <td><?=$detail->qty ?></td>
             <td><?=$detail->price ?></td>
 		
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