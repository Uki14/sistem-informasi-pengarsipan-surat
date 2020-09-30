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
                <h1 class="h3 mb-4 text-gray-800">Profil saya</h1>
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
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= $this->session->image == '' ? 'https://via.placeholder.com/1000?text=Foto Profil' : base_url('assets/files/profile/' . $this->session->image) ?>" class="card-img m-1" alt="user-image" style="width: 150px; height: 150px; object-fit: cover; object-position: center; border-radius: 50%">
                            </div>

                            <div class="d-flex m-3 justify-content-around">
                                <a href="<?= base_url('users/edit_profile') ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="<?= base_url('users/edit_password') ?>" class="btn btn-primary btn-sm"><i class="fas fa-key"></i></a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"> <?= $this->session->nama_lengkap ?></h4>
                                </h5>
                                <p class="card-text">username: <?= $this->session->username ?></p>
                                <p class="card-text">bio: <?= $this->session->bio ?></p>
                                <p class="card-text">
                                    email: <?= $this->session->email ?>
                                </p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
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