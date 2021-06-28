<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMC - Sistem Manajem Counter</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/app.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-7 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                       <h4>Sistem Manajemen</h4><h5>Penjualan, Pembelian dan Service</h5>
                       <h5>Smartphone</h5>
                       <hr>
                    </div>
                  
                    <?php echo $this->session->flashdata('success');?>
                    <?php echo $this->session->flashdata('error');?>
                    <?php echo form_open('login/proses_login'); ?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Masukkan Username" name="username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl"  placeholder="Masukkan Password" name="password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                   
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                        
                    </form>
                
                </div>
            </div>
          
        </div>

    </div>
</body>

</html>