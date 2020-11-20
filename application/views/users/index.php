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
                <h1 class="h3 mb-4 text-gray-800">Users</h1>
                <div class="card mb-3">
                    <div class="card-body">
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
                        <div class="row">
                            <?php if ($user == 'superadmin') {
                            ?>
                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-flat btn-block" data-toggle="modal" data-target="#tambah_user"><i class="fas fa-plus"></i> Tambah user </button>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <?php if ($user == 'superadmin') { ?><th>Aksi</th><?php } else {
                                                                                        } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($users as $u) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $u->nama_lengkap; ?></td>
                                            <td><?= $u->username; ?></td>
                                            <td><?php
                                                if ($u->level == 1) {
                                                    echo 'Superadmin';
                                                } else {
                                                    echo 'Admin';
                                                }
                                                ?>
                                            </td>
                                            <?php if ($user == 'superadmin') {
                                            ?>
                                                <td>
                                                    <a href="<?= base_url('users/delete/' . $u->id_user) ?>" onclick="return confirm('Hapus user ini?')" class="badge badge-danger">hapus</a><br>
                                                    <?php if ($u->level == "2") { ?>
                                                        <a href="<?= base_url('users/change_level/' . $u->id_user) ?>" class="badge badge-info">Jadikan Super Admin</a>
                                                    <?php } else { ?>
                                                        <?php if ($u->id_user == $this->session->userdata('id_user')) : ?>
                                                            <a href="<?= base_url('users/profile/') ?>" class="badge badge-primary">Profil saya</a>
                                                        <?php
                                                        else :
                                                        ?>
                                                            <a href="<?= base_url('users/change_level/' . $u->id_user) ?>" class="badge badge-info">Jadikan Admin</a>
                                                        <?php
                                                        endif;
                                                        ?>
                                                    <?php } ?>
                                                </td>
                                            <?php  }
                                            ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <?php $this->load->view('templates/copyright') ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>


<div class="modal fade" id="tambah_user">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <form role="form" action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nama lengkap</label>
                            <div class="input-group">
                                <input type="text" name="nama_lengkap" autocapitalize="true" class="form-control" placeholder="Nama lengkap..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <div class="input-group">
                                <input type="text" name="username" class="form-control" placeholder="Username..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" autocomplete="off" name="password" class="form-control" placeholder="Password..." required>
                            </div>
                            <span class="text-danger" id="passwordvalidasi"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Konfirmasi password</label>
                            <div class="input-group">
                                <input type="password" id="password2" onkeyup="validatePassword()" autocomplete="off" name="password2" class="form-control" placeholder="Password..." required>
                            </div>
                            <span class="text-danger" id="passwordvalidasi"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Level</label>
                            <select class="form-control" name="level" id="">
                                <option value="2">Admin</option>
                                <option value="1">Super Admin</option>
                            </select>
                        </div>
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" name="tambah" class="btn btn-primary tambahuser">Tambah</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    const password = document.querySelectorAll('#password')[1]
    const password_konfirmasi = document.querySelectorAll('#password2')[1]

    const validatePassword = () => {
        // console.log(password_konfirmasi.value)
        if (password.value !== password_konfirmasi.value) {
            const passValidasi = document.querySelectorAll('#passwordvalidasi')
            passValidasi.innerText = 'Password dan konfirmasi harus sesuai';
        }
    }
</script>