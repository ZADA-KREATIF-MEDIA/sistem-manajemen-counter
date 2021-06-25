<div class="card-body">
    <div class="alert alert-light-primary">
        <h4 class="alert-heading">Data Barang/Smartphone</h4>
        <p>Pada tabel di bawah merupakan data barang yang tersedia dalam toko.</p>
        <hr>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
                Tambah Data Pengguna
            </button>
    </div>
    
</div>

<div class="card-body">


       
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($user as $item) : ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $item->username ?></td>
                                <td><?php echo $item->nama ?></td>
                                <td><?php echo $item->no_telp ?></td>
                                <td><?php echo $item->level ?></td>
                                <td class="text-center">
                                    <button data-bs-target="#editUser<?php echo $item->id_user; ?>" type="button" class="btn btn-sm btn-primary" title="Edit" data-bs-toggle="modal" ><span>EDIT<span>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="alertUser(<?php echo $item->id_user; ?>)" title="Hapus"><span>HAPUS</span></button>
                                </td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        
    </div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan User Baru</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url(); ?>user/store" method="POST">
                <div class="modal-body">
                    <div class="alert alert-danger">
                        Pastikan Nama/Inisial, Username dan Password Unik (Berbeda 1 dan yang lain) di karenakan digunakan untuk perhitungan data oleh sistem
                        <ul>
                            <li>Hapus User yang sudah tidak terpakai untuk penghematan memori</li>
                            <li>Gunakan Password yang baik , gabungan huruf dan angka</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukkan Nomor Telpon">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option>--Pilih Level User--</option>
                            <option value="admin">ADMIN</option>
                            <option value="penjual">PENJUAL</option>
                            <option value="teknisi">TEKNISI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" class="form-control" placeholder="Masukkan Alamat"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tambah User -->
<?php foreach ($user as $item) : ?>
    <div class="modal fade" id="editUser<?php echo $item->id_user ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url(); ?>user/update" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_user" value="<?php echo $item->id_user; ?>">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $item->nama; ?>" placeholder="Masukkan Nama">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" value="<?php echo $item->username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukkan Nomor Telpon" value="<?php echo $item->no_telp; ?>">
                        </div>
                        <div class="form-group">
                            <select name="level" id="level" class="form-control">
                                <option>--Pilih Level User--</option>
                                <option value="admin" <?php if ($item->level == "admin") {
                                                            echo "selected";
                                                        } ?>>ADMIN</option>
                                <option value="penjual" <?php if ($item->level == "penjual") {
                                                            echo "selected";
                                                        } ?>>PENJUAL</option>
                                <option value="teknisi" <?php if ($item->level == "teknisi") {
                                                            echo "selected";
                                                        } ?>>TEKNISI</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" class="form-control" placeholder="Masukkan Alamat"><?php echo $item->alamat; ?></textarea>
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
</script>