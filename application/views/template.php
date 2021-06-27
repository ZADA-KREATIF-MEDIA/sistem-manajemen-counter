<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Andi Hoerudin">
  <meta name="author" content="Andi Hoerudin">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SMC</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendors/iconly/bold.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/app.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header">
          <div class="d-flex justify-content-between">
            <div class="logo">
              <a href="<?php echo site_url('dashboard') ?>">SMC</a>
            </div>
            <div class="toggler">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>
        <?php $this->load->view('partials/sidebar.php') ?>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
      </div>
    </div>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>
      <div class="page-content">
        <section class="row">
          <div class="col-12 col-lg-12">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <?php echo $contents ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <footer>
        <div class="footer clearfix mb-0 text-muted">
          <div class="float-start">
            <p>2021 &copy; STMIK AKAKOM - FRANKY NOVAN</p>
          </div>

        </div>
      </footer>
    </div>
  </div>



  <!-- JQUERY -->
  <script src="<?= base_url() ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="<?= base_url() ?>assets/vendors/apexcharts/apexcharts.js"></script>
  <script src="<?= base_url() ?>assets/js/pages/dashboard.js"></script> -->

  <script src="<?= base_url() ?>assets/js/main.js"></script>

  <!-- Jquery Plugin-->
  <script src="<?php echo base_url() ?>assets_old/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets_old/js/scripts.js"></script>
  <script src="<?php echo base_url() ?>assets_old/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>assets_old/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->

  <script src="<?php echo base_url(); ?>assets_old/vendor/jquery-ui/jquery-ui.js"></script>
  <script src="<?php echo base_url() ?>assets_old/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets_old/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets_old/vendor/datatables/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url() ?>assets_old/vendor/datatables/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/jquery.mask.js"></script>
  <script src="<?php echo base_url() ?>assets_old/vendor/sweetalert2/sweetalert2.all.min.js"></script>



  <script>
    function convertToRupiah(angka) {
      var rupiah = '';
      var angkarev = angka.toString().split('').reverse().join('');
      for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
      return rupiah.split('', rupiah.length - 1).reverse().join('');
    }
    $(document).ready(function() {
      $("#dataTable").DataTable({});
      $('.uang').mask('000.000.000', {
        reverse: true
      });
      $(function() {
        $(".datepicker").datepicker({
          dateFormat: 'dd-mm-yy'
        });
      });
      // Module Penjualan
      $("select#kode_barang").change(function() {
        var id_barang = $(this).val();
        $("#imei").text(id_barang);
        $("#imei").val(id_barang);
        $.ajax({
          url: "<?php echo base_url('transaksi/get_harga_jual'); ?>",
          method: "POST",
          data: {
            id_barang: id_barang
          },
          success: function(res) {
            var data = $.parseJSON(res);
            console.log(data);
            $("#namaBarang").val(data.nama_barang);
            $("#hargaBeli").val(convertToRupiah(data.harga_beli));
            $("#hargaBarang").val(data.harga_beli);
          }
        })
      });
      $('#dataTable_filter').addClass("float-end");
      $('#dataTable_paginate').addClass("float-end");
    });
    // Module Service Bagian Edit
    function deleteHW(id) {
      $("#hapusHW_" + id).remove();
      Swal.fire({
        text: "Apakah anda yakin akan menghapus part Hardware ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('service/destroy_service_part'); ?>",
            method: "POST",
            data: {
              id_service: id
            },
            success: function(res) {
              Swal.fire(
                'Deleted!',
                'Part Berhasil di hapus.',
                'success'
              );
              location.reload();
            }
          });
        }
      });
    }

    function deleteSW(id) {
      $("#hapusSW_" + id).remove();
      Swal.fire({
        text: "Apakah anda yakin akan menghapus part software ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('service/destroy_service_software'); ?>",
            method: "POST",
            data: {
              id_service: id
            },
            success: function(res) {
              Swal.fire(
                'Deleted!',
                'Part Berhasil di hapus.',
                'success'
              );
              location.reload();
            }
          })
          Swal.fire(
            'Deleted!',
            'Part Berhasil di hapus.',
            'success'
          );
        }
      });
    }

    function hapusPart(id) {
      Swal.fire({
        text: "Apakah anda yakin akan menghapus data part ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          window.location.href = "<?php echo base_url(); ?>service/delete_part/" + id
        }
      })
    }

    function hapusService(id) {
      // console.log(id);
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Akan menghapus data service customer?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('service/delete'); ?>",
            method: "POST",
            data: {
              id_customer: id
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
    // Module Laporan Pembelian
    function alertHapus(id) {
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Akan menghapus data laporan pembelian?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('Laporan_pembelian/hapus'); ?>",
            method: "POST",
            data: {
              kode_pembelian: id
            },
            success: function(res) {
              Swal.fire(
                'Deleted!',
                'Data laporan pembelian berhasil di hapus.',
                'success'
              );
              location.reload();
            }
          })
        }
      })
    }

    function editPembelian(id) {
      $.ajax({
        url: "<?php echo base_url('laporan_pembelian/get_harga_keterangan_pembelian'); ?>",
        method: "POST",
        data: {
          id: id
        },
        beforeSend: function() {
          $('#loader').modal({
            backdrop: 'static',
            keyboard: false
          })
          setTimeout(function() {
            $('#loader').modal('hide');
          }, 1000);
        },
        success: function(res) {
          var data = $.parseJSON(res);
          $("#kodePembelian").val(data.kode_pembelian);
          $("#hargaPembelian").val(convertToRupiah(data.harga_beli));
          $("#keterangan").val(data.keterangan);
          $("#keterangan").text(data.keterangan);
          $('#laporanPenjualanModal').modal('show');
        }
      });
    }
    $("#pembayaran").change(function() {
      var status = $("#pembayaran").val();
      if (status == "hutang") {
        $("#blockUangMuka").removeClass('d-none');
        $("#blockTanggalJatuhTempo").removeClass('d-none');
      } else {
        $("#blockUangMuka").addClass('d-none');
        $("#blockTanggalJatuhTempo").addClass('d-none');
      }
    });
    // Module Laporan Penjualan 
    function hapusLaporanPenjualan(id) {
      Swal.fire({
        title: 'Apakah Anda Yakin',
        text: "Akan menghapus data laporan penjualan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('Laporan_penjualan/hapus'); ?>",
            method: "POST",
            data: {
              id: id
            },
            success: function(res) {
              Swal.fire(
                'Deleted!',
                'Data laporan penjualan berhasil di hapus.',
                'success'
              );
              location.reload();
            }
          })
        }
      })
    }
    // Module Barang 
    function ubahInStock(id) {
      Swal.fire({
        text: "Apakah anda yakin akan menghapus data barang ini dari keranjang transaksi?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('barang/hapus_tmp'); ?>",
            method: "POST",
            data: {
              id: id
            },
            success: function(res) {
              Swal.fire(
                'Deleted!',
                'Barang berhasil di hapus.',
                'success'
              );
              location.reload();
            }
          });
        }
      })
    }

    function hapusBarang(id) {
      Swal.fire({
        text: "Apakah anda yakin akan menghapus data barang?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('barang/hapus'); ?>",
            method: "POST",
            data: {
              id: id
            },
            success: function(res) {
              console.log(res);
              Swal.fire(
                'Deleted!',
                'Barang berhasil di hapus.',
                'success'
              );
              location.reload();
            }
          });
        }
      })
    }
    // Module Pemasukan 
    function hapusPemasukan(id) {
      Swal.fire({
        text: "Apakah anda yakin akan menghapus data pemasukan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('pemasukan/hapus'); ?>",
            method: "POST",
            data: {
              id: id
            },
            success: function(res) {
              Swal.fire(
                'Deleted!',
                'Barang berhasil di hapus.',
                'success'
              );
              location.reload();
            }
          });
        }
      })
    }
    // Module Pengeluaran 
    function hapusPengeluaran(id) {
      Swal.fire({
        text: "Apakah anda yakin akan menghapus data pengeluaran?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('pengeluaran/hapus'); ?>",
            method: "POST",
            data: {
              id: id
            },
            success: function(res) {
              Swal.fire(
                'Deleted!',
                'Barang berhasil di hapus.',
                'success'
              );
              location.reload();
            }
          });
        }
      })
    }
    // Module Gaji 
    function hapusGaji(id) {
      Swal.fire({
        text: "Apakah anda yakin akan menghapus data gaji?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('gaji/hapus'); ?>",
            method: "POST",
            data: {
              id: id
            },
            success: function(res) {
              Swal.fire(
                'Deleted!',
                'Barang berhasil di hapus.',
                'success'
              );
              location.reload();
            }
          });
        }
      })
    }
    // Module Saldo Awal
    function hapusSaldoAwal(id) {
      Swal.fire({
        text: "Anda yakin akan menghapus data saldo awal?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          window.location.href = "<?php echo base_url(); ?>saldo_awal/destroy/" + id
        }
      })
    }
    // Module Piutang
    $("select#piutang").change(function() {
      var id = $(this).val();
      $.ajax({
        url: "<?php echo base_url('piutang/get_harga_piutang'); ?>",
        method: "POST",
        data: {
          id: id
        },
        success: function(res) {
          var hasil = $.parseJSON(res);
          $("#jumlah_hutang").val(convertToRupiah(hasil.nominal_piutang));
        }
      })

    });

    function restartPiutang(id) {
      Swal.fire({
        title: 'Apakah anda yakin menghapus data transaksi piutang?',
        text: "Jika anda menghapus data piutang berarti seluruh histori transaksi akan hilang dan kembali ke transaksi awal",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('piutang/reset_data_piutang'); ?>",
            method: "POST",
            data: {
              id: id
            },
            success: function(res) {
              location.reload();
            }
          });
        }
      });
    }
    // Module Hutang
    $("select#hutang").change(function() {
      var id = $(this).val();
      $.ajax({
        url: "<?php echo base_url('hutang/get_harga_hutang'); ?>",
        method: "POST",
        data: {
          id: id
        },
        success: function(res) {
          var hasil = $.parseJSON(res);
          $("#jumlah_hutang").val(convertToRupiah(hasil.nominal_hutang));
        }
      })

    });

    function restartHutang(id) {
      Swal.fire({
        title: 'Apakah anda yakin menghapus data transaksi hutang?',
        text: "Jika anda menghapus data hutang berarti seluruh histori transaksi akan hilang dan kembali ke transaksi awal",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?php echo base_url('hutang/reset_data_hutang'); ?>",
            method: "POST",
            data: {
              id: id
            },
            success: function(res) {
              location.reload();
            }
          });
        }
      });
    }
    // Modul Export Excel Laporan Bulanan & Harian
    function exportExcelBulanan(tanggal) {
      if (tanggal != 0) {
        window.location.href = "<?php echo base_url(); ?>laporan_laba_rugi/export_bulanan/" + tanggal
      } else {
        window.location.href = "<?php echo base_url(); ?>laporan_laba_rugi/export_bulanan"
      }
    }

    function exportExcelHarian(hari) {
      if (hari != 0) {
        window.location.href = "<?php echo base_url(); ?>laporan_laba_rugi/export_harian/" + hari
      } else {
        window.location.href = "<?php echo base_url(); ?>laporan_laba_rugi/export_harian"
      }
    }
    /*--------- Error & Success Handling ---------*/
    /* Modul Transaksi */
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "tmp_kosong") : ?>
      Swal.fire({
        text: "Harap mengisikan data transaksi penjualan terlebih dahulu!",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      })
    <?php endif; ?>
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "berhasil simpan temp") : ?>
      Swal.fire({
        text: "Berhasil di tambahkan di keranjang penjualan",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      })
    <?php endif; ?>
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "transaksi success") : ?>
      Swal.fire({
        text: "Transaksi Penjualan Berhasil",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
    /* Modul Pembelian */
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "pembelian sukses") : ?>
      Swal.fire({
        text: "Transaksi Pembelian Berhasil",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
    /* Modul Laporan Pembelian */
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "edit laporan pembelian berhasil") : ?>
      Swal.fire({
        text: "Edit Data Laporan Pembelian Berhasil",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
    /* Modul Laporan Penjualan */
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "edit laporan penjualan berhasil") : ?>
      Swal.fire({
        text: "Edit Data Laporan Penjualan Berhasil",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
    /* Modul Pemasukan */
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "pemasukan success") : ?>
      Swal.fire({
        text: "Berhasil Menambahkan Data Pemasukan",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "edit pemasukan success") : ?>
      Swal.fire({
        text: "Berhasil Edit Data Pemasukan",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
    /* Modul Pengeluaran */
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "tambah pengeluaran") : ?>
      Swal.fire({
        text: "Berhasil Menambahkan Data Pengeluaran",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "edit pengeluaran") : ?>
      Swal.fire({
        text: "Berhasil Edit Data Pengeluaran",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
    /* Modul Gaji */
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "tambah gaji") : ?>
      Swal.fire({
        text: "Berhasil Menambahkan Data Gaji",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == "edit gaji") : ?>
      Swal.fire({
        text: "Berhasil Edit Data Gaji",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.value) {
          <?php unset($_SESSION['msg']); ?>
        }
      });
    <?php endif; ?>
  </script>
</body>

</html>