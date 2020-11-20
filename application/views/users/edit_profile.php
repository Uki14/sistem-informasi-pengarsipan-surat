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
                <h1 class="h3 mb-4 text-gray-800">Ubah Profil saya</h1>
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
                    <?= form_open_multipart('users/update_profile') ?>
                    <div class="card-body">
                        <img src="<?= $this->session->image == '' ? 'https://via.placeholder.com/1000?text=Foto Profil' : base_url('assets/files/profile/' . $this->session->image) ?>" alt="" class="d-block mx-auto" style="width: 200px; height: 200px; object-fit: cover; object-position: center; border-radius: 50%">
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= $this->session->nama_lengkap ?>" placeholder="Nama...">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" id="username" value="<?= $this->session->username ?>" placeholder="Username...">
                            <span class="text-danger">Pastikan Anda mengingat username ini karena ini akan digunakan saat login aplikasi, username anda harus tanpa spasi</span>
                        </div>
                        <div class="form-group">
                            <label for="">Foto Profil</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Gambar</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="gambar" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01"><?= $this->session->image == '' ? 'Pilih gambar' : $this->session->image ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?= $this->session->email ?>" placeholder="Email...">
                        </div>
                        <div class="form-group">
                            <label for="">Bio</label>
                            <textarea name="bio" id="" cols="30" rows="5" name="bio" placeholder="Bio..." class="form-control"><?= $this->session->bio ?></textarea>
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