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
                <h1 class="h3 mb-4 text-gray-800">Disposisi #<?php echo $suratmasuk['no_suratmasuk'] ?></h1>
                <div class="card">
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
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <div class="callout callout-success">
                                    <h3><i class="fas fa-file-alt"></i> PERIHAL SURAT : <span class="text-danger"><?php echo $suratmasuk['judul_suratmasuk']; ?></span>
                                        <button type="button" class="btn btn-primary float-sm-right" data-id-suratmasuk="<?= $suratmasuk['judul_suratmasuk'] ?>" data-toggle="modal" data-target="#tambahdisp"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;<span>Tambah Disposisi</span></button>
                                </div>
                                <!-- /.card-body -->
                                <br>
                                <div class="table-responsive">
                                    <table id="tabeldisposisi" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Pengisi Disposisi</th>
                                                <th>Diteruskan Kepada</th>
                                                <th>Catatan</th>
                                                <th>Instruksi/Informasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($disposisi as $ds) : ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $ds->pengisi; ?></td>
                                                    <td><?php echo $ds->tujuan; ?></td>
                                                    <td><?php echo $ds->catatan; ?></td>
                                                    <td><?php echo $ds->instruksi; ?></td>
                                                    <td>
                                                        <a href="<?= base_url('suratmasuk/print_disposisi/' . $ds->id_disposisi) ?>" target="_blank" class="badge badge-success d-block">cetak</a>
                                                        <br>
                                                        <a href="<?= base_url('suratmasuk/delete_disposisi/' . $ds->id_disposisi . '?id_suratmasuk=' . $suratmasuk['id_suratmasuk']) ?>" onclick="return confirm('Hapus disposisi ini?')" class="badge badge-danger d-block">hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- add button, print, and table -->
                        </div>
                    </div>
                    <!-- /.card-body -->
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

<div class="modal fade" id="tambahdisp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" action="<?= base_url('suratmasuk/store_disposisi/' . $suratmasuk['id_suratmasuk']) ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pengisi disposisi</label>
                                    <select name="pengisi" id="pengisi" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                                        <option value="Staff Tata Usaha">Staff Tata Usaha</option>
                                        <option value="Wakil Kurikulum">Wakil Kurikulum</option>
                                    </select>
                                    <small><span class="text-danger text-small" id="alertpengisi"></span></small>
                                </div>
                                <div class="form-group">
                                    <label>Diteruskan kepada</label>
                                    <input type="text" name="tujuan" id="tujuan" class="form-control" placeholder="Tujuan" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Instruksi/Informasi</label>
                                    <input type="text" name="instruksi" class="form-control" placeholder="Instruksi..">
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea name="catatan" class="form-control" placeholder="Catatan"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>