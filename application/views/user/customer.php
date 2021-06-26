<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Customer</a>
        </li>
        <li class="breadcrumb-item active">Data Customer</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            DATA Customer
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambahCustomerModal">
                Tambah Customer
            </button>
        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($customer as $item) : ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $item->nama ?></td>
                                <td><?php echo $item->no_telpn ?></td>
                                <td><?php echo $item->tgl_daftar ?></td>
                                <td class="text-center">
                                    <button data-bs-target="#editCustomer<?php echo $item->id_customer; ?>" type="button" class="btn btn-info" title="Edit" data-bs-toggle="modal" ><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="alertCustomer(<?php echo $item->id_customer; ?>)" title="Hapus"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah CUstomer -->
<div class="modal fade" id="tambahCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan User Baru</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url(); ?>user/store_customer" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukkan Nomor Telpon">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tambah Customer -->
<?php foreach ($customer as $item) : ?>
    <div class="modal fade" id="editCustomer<?php echo $item->id_customer ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit CUstomer</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url(); ?>user/update_customer" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_customer" value="<?php echo $item->id_customer; ?>">
                        <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="<?= $item->nama ?>">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukkan Nomor Telpon" value="<?= $item->no_telpn?>">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat"><?= $item->alamat ?></textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script src="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    function alertUser(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Akan menghapus data user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url('user/destroy'); ?>",
                    method: "POST",
                    data: {
                        id_user: id
                    },
                    success: function(res) {
                        // console.log(res)
                        Swal.fire(
                            'Deleted!',
                            'Data customer berhasil di hapus.',
                            'success'
                        );
                        location.reload();
                    }
                })
            }
        })
    }
    function alertCustomer(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Akan menghapus data user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url('user/destroy_customer'); ?>",
                    method: "POST",
                    data: {
                        id_user: id
                    },
                    success: function(res) {
                        // console.log(res)
                        Swal.fire(
                            'Deleted!',
                            'Data customer berhasil di hapus.',
                            'success'
                        );
                        location.reload();
                    }
                })
            }
        })
    }
</script>