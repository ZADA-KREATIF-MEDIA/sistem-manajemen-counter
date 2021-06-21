<style type="text/css">
#barang::-webkit-scrollbar {
    display: none;
}
</style>
<div class="container-fluid">
<ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Transaksi</a>
        </li>
        <li class="breadcrumb-item active">Pembelian Barang</li>
    </ol>
	<div class="card shadow mb-12">
		<div class="card-header">
			<i class="fa fa-book"></i> Transaksi Pembelian Barang
		</div>
	
		<div class="card-body">
			<div class="row">
				 <div class="col-md-6"> 
					<!--<button class="btn btn-block btn-info" id="tambah" onclick="add()">Tambah barang</button>-->
					<br>
				</div>
			</div>
			<form method="post" class="form-horizon" action="<?=base_url('pembelian/save_barang') ?>">
				<div class="col-md-12">
					<h4>DATA BARANG</h4>
					<hr class="bg-primary">
				</div>
				<div class="form-group col-md-12">
					<strong><label>Petugas/Sales</label></strong>
					<input type="text" name=nama_petugas value=<?php echo $this->session->userdata('nama') ?> class="form-control" disabled>
					
				</div>
				<div class="form-group col-md-12">
					<strong><label>IMEI/SERIAL NUMBER</label></strong>
					<input type="text" name="imei" class="form-control harga" placeholder="Masukan IMEI/Serial number barang" required>
				</div>	
				<div class="form-group col-md-12">
					<strong><label>Nama Barang</label></strong>
					<input type="text" name="nama_barang" placeholder="Masukan nama Barang" class="form-control" required>
				</div>
				<div class="form-group col-md-12">
					<strong><label>Harga barang</label></strong>
					<input type="text" name="harga" class="form-control harga uang" placeholder="Masukan harga barang"  required>
				</div>
				<div class="form-group col-md-12">
					<strong><label>Keterangan</label></strong>
					<textarea name="keterangan" class="form-control " rows="4" cols="50" placeholder="Masukan  keterangan barang kelengkapan, kondisi dan keterangan tambahan lainya"></textarea>
				</div>
				<div class="row col-md-12">
					<div class="col-md-4">
						<div class="form-group">
							<strong><label for="pembayaran">Metode Pembayaran</label></strong>
							<select name="pembayaran" id="pembayaran" class="form-control" required="">
								<option>-- Pilih Metode Pembayaran --</option>
								<option value="cash">Cash</option>
								<option value="transfer">Transfer</option>
								<option value="hutang">Hutang</option>
							</select>
						</div>
					</div>
					<div class="col-md-4 d-none" id="blockUangMuka">
						<div class="form-group">
							<label for="uang_muka">Uang Muka</label>
							<input type="text" class="form-control uang" name="uang_muka" id="uang_muka" placeholder="Masukkan Uang Muka">
						</div>
					</div>
					<div class="col-md-4 d-none" id="blockTanggalJatuhTempo">
						<div class="form-group">
							<label for="tanggalJatuhTempo">Tanggal Jatuh Tempo</label>
							<input type="text" class="form-control datepicker" name="tanggal_jatuh_tempo" id="tanggalJatuhTempo">
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<h4>DATA PEMBELI</h4>
					<hr class="bg-success">
				</div>
				<div class="form-group col-md-12">
					<strong><label>Customer</label></strong>
					<input type="text" name="nama" placeholder="Masukan nama customer" class="form-control">
				</div>
				<div class="form-group col-md-12">
					<strong><label>No Hp</label></strong>
					<input type="text" name="no_telpn" placeholder="Masukan nomor telephone customer" class="form-control" maxlength="12">
				</div>
			
				<div class="form-group col-md-12">
					<strong><label>Alamat</label></strong>
					<textarea name="alamat" rows="4" cols="50" class="form-control " placeholder="Masukan alamat lengkap customer" required></textarea>
				</div>
				<div class="col-md-12">
					<br><br>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Data</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
<script type="text/javascript">
	var id = 1;
	function add(){
		
		id += 1;
		var item = '<div class="row produk-item" style="border:1px solid #ddd" id="hapus_'+id+'">'+
			 			'<div class="form-group col-md-6">'+
			 			'<label>Nama Barang</label>'+
			 			'<input type="text" name="barang[]" class="form-control" required>'+
			 		'</div>'+
			 		'<div class="form-group col-md-2">'+
			 			'<label>Jumlah</label>'+
			 			'<input type="number" name="jumlah[]" class="form-control jumlah" value="1" required>'+
			 		'</div>'+
			 		'<div class="form-group col-md-3">'+
			 			'<label>Harga/barang</label>'+
			 			'<input type="number" name="harga[]" class="form-control harga" value="0" required>'+
			 		'</div>'+
			 		'<div >'+
			 			'<button style="height: 100%;width:100%" class="btn btn-danger" title="hapus barang" onclick="delet('+id+')">'+
			 				'<i class="fa fa-trash "></i>'+
			 			'</button>'+
			 		'</div>'+
			 		'</div>';

		$('#barang').append(item);
	}
        $("#tambah").click(function(){
          $(".item-barang").each(function(){
            alert($(this).html());
          });
        });
	function delet(id){
		$("#hapus_"+id).remove();
	}
	$(function() {
    $(".form-horizon").on('change paste keyup',function() {
        var subtotal = 0;
        $(".form-horizon .produk-item").each(function() {

            var qty = parseInt($(this).find(".jumlah").val());
            var rate = parseInt($(this).find(".harga").val());
            //var tax_rate = parseInt($(this).find(".tax").val());

            subtotal += qty * rate;
            console.log(subtotal);
           

   //          var bilangan = subtotal;
	
			// var	number_string = bilangan.toString(),
			// 	sisa 	= number_string.length % 3,
			// 	rupiah 	= number_string.substr(0, sisa),
			// 	ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
					
			// if (ribuan) {
			// 	separator = sisa ? '.' : '';
			// 	subtotal += separator + ribuan.join('.');
			// }
			 $("#total2").text(subtotal);
			 $('#total').val(subtotal);
			// Cetak hasil
			//document.write(rupiah); // Hasil: 23.456.789
        });
        //$(".sub").val(sub);
     });
 })



	// $('.form-horizon').keyup(function(event){
		

	// 	$('.form-horizon .form-group').each(function(){

	// 		//$('.form-group').on('change paste keyup',function(){
	// 			var harga = 0;
	// 	        var jumlah = 0;

	// 		      harga = parseFloat($(this).find(".harga").val());
			
	// 		      jumVal = parseFloat($(this).find(".jumlah").val());

	// 			 var jumlah = harga * jumVal;

	// 			console.log(jumlah.toFixed(2)); 
	// 			$('#total2').text(jumlah);
	// 			$('#total').val(jumlah);
	// 		//})	

	// 	})
	//   })


	</script>