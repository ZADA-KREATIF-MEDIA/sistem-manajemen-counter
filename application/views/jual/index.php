<style type="text/css">
#barang::-webkit-scrollbar {
    display: none;
}
</style>
<div class="container-fluid">
	<div class="card shadow mb-12">
		<div class="card-header">
			Transaksi Penjualan
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6"> 
					<button class="btn btn-block btn-info" id="tambah" onclick="add()">Tambah barang</button>
					<br>
				</div>
			</div>
			<form method="post" class="form-horizon" action="<?=base_url('penjualan/save_barang') ?>" target="_blank">
				<div class="row">
					<div class="col-md-7"  >
						<div id="barang" style="height: 350px;overflow:auto; ">
							<div class="row produk-item" style="border:1px solid #ddd" id="hapus_1"  autofocus required>
								<div class="form-group col-md-6">
								<label>Nama Barang</label>
								<input type="text" name="barang[]" class="form-control" required>
							</div>
							<div class="form-group col-md-2">
								<label>Jumlah</label>
								<input type="number" name="jumlah[]" class="form-control jumlah" value="1" required>
							</div>
							<div class="form-group col-md-3">
								<label>Harga/barang</label>
								<input type="number" name="harga[]" class="form-control harga" value="0" required>
							</div>
							<div >
								<button style="height: 100%;width:100%" class="btn btn-danger" title="hapus barang" onclick="delet(1)">
									<i class="fa fa-trash "></i>
								</button>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 " >
						<div class="row">
							<div class="form-group col-md-12">
								<label>Nama Pembeli</label>
								<input type="text" name="nama" class="form-control">
								
							</div>
							<div class="form-group col-md-12">
								<label>No Hp</label>
								<input type="text" name="no_tel" class="form-control">
								
							</div>
							
							<div class="col-md-12">
								
								<div class="row">
									<div class="col-md-3"><b>Total :</b></div>
									<div class="col-md-6">
										<input type="hidden" name="total" id="total" >
											<b id="total2"></b>
									</div>
								</div>
								<br>
								<br>
								<button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak Nota</button>
							</div>
						</div>
					</div>
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
				subtotal += qty * rate;
				$("#total2").text(subtotal);
				$('#total').val(subtotal);
			});
		});
	});
</script>