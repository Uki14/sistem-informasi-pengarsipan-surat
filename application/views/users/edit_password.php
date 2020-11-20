<div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php $this->load->view('templates/topbar'); ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Ubah Password saya</h1>
                <div class="card mb-3" style="max-width: 540px;">
                    <?php
                    if ($this->session->flashdata('success')) :
                    ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Sukses</h5>
                            <?= $this->session->flashdata('success') ?>
                        </div>
                    <?php
                    endif;
                    if ($this->session->flashdata('error')) :
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-times"></i> Gagal</h5>
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?= form_open_multipart('users/update_password') ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Password Lama</label>
                            <input type="password" name="password" class="form-control" id="username" value="" placeholder="Password lama..." required>
                        </div>
                        <div class="form-group">
                            <label for="">Password Baru</label>
                            <input type="password" name="newpassword" class="form-control" id="passwordconf" value="" placeholder="Password baru..." required>
                        </div>
                        <div class="form-group">
                            <label for="">Konfirmasi Password Baru</label>
                            <input type="password" name="newpasswordconf" class="form-control" id="newpasswordconf" value="" placeholder="Konfirmasi password baru..." required>
                            <span class="text-danger">Pastikan Anda mengingat password ini karena ini akan digunakan saat login aplikasi.</span>
                        </div>
                        <div class="text-center"><a href="<?= base_url('users/profile') ?>" class="btn btn-secondary px-3">BATAL</a><button type="submit" class="btn btn-primary px-3 ml-3">UBAH</button></div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <!-- modal tambah -->
        <!-- Footer -->
        <?php $this->load->view('templates/copyright') ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>