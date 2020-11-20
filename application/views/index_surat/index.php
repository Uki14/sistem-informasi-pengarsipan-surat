<div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar'); ?>

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
                <h1 class="h3 mb-4 text-gray-800">Indeks</h1>
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
                            <div class="col-md-auto">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#tambah_index">Tambah indeks</button>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Indeks</th>
                                        <th>Nama Indeks</th>
                                        <th>Detail</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($index_surat as $i) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $i->kode_indeks; ?></td>
                                            <td><?= $i->judul_indeks; ?></td>
                                            <td><?= '<div class=text-justify>' . $i->detail . '</div>'; ?></td>
                                            <td>
                                                <a href="<?= base_url('indexsurat/edit/' . $i->id_indeks) ?>" class="badge badge-primary ">Edit</a>
                                                <br>

                                                <a href="<?= base_url('indexsurat/delete/' . $i->id_indeks) ?>" class="badge badge-danger d-block" onclick="return confirm('Hapus data ini?')"><span>Hapus</span></a><br>
                                            </td>
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
        <!-- Footer -->
        <?php $this->load->view('templates/copyright') ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<div class="modal fade" id="tambah_index">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('indexsurat/store') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Kode Indeks</label>
                    <div class="input-group">
                        <input type="text" name="kode_index" maxlength="5" class="form-control" placeholder="Kode Indeks..." required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Nama Indeks</label>
                    <div class="input-group">
                        <input type="text" name="judul_index" class="form-control" placeholder="Nama Indeks..." required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Detail</label>
                    <textarea name="detail" id="" required class="form-control" rows="5" placeholder="Tambah detail dipisah dengan koma (contoh: undangan rapat, undangan pegawai, dll.. / ketik \'-' jika detail kosong"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="ubah_index" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ubah Indeks</h5>
                </div>
                <?php echo form_open('indexsurat/update')
                ?>
                <div class="card-body">
                    <div class="form-group"><label for="kode_indeks"></label><input id="kode_indeks" name="kode_indeks" type="text" class="form-control"></div>
                    <div class="form-group"><label for="judul_indeks"></label><input id="judul_indeks" name="judul_indeks" type="text" class="form-control"></div>
                    <div class="form-group"><label for="detail"></label><textarea id="detail" name="detail" class="form-control"></textarea></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ubah</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const toggleUbahIndex = document.getElementById('toggle-ubah-index')

    function ubahIndex(e) {
        console.log(toggleUbahIndex.getAttribute('data-id_indeks'))
    }
</script>