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
                <h1 class="h3 mb-4 text-gray-800">Surat Masuk</h1>
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
                                    <button class="btn btn-primary btn-flat btn-block" data-toggle="modal" data-target="#tambah_suratmasuk"><i class="fas fa-plus"></i> Tambah data </button>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor Surat</th>
                                        <th>Judul Surat</th>
                                        <th>Indeks</th>
                                        <th>Asal Surat</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Keterangan</th>
                                        <th>Berkas</th>
                                        <?php if ($user == 'superadmin') {   ?><th>Aksi</th><?php }                 ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($suratmasuk as $sm) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $sm->no_suratmasuk; ?></td>
                                            <td><?= $sm->judul_suratmasuk; ?></td>
                                            <td>
                                                <?php
                                                $indeks = $this->db->get_where('indeks', ['id_indeks' => $sm->id_indeks])->result();
                                                echo $indeks[0]->judul_indeks;
                                                ?>
                                            </td>
                                            <td><?= $sm->asal_surat; ?></td>
                                            <td><?php $date = date_create($sm->tanggal_masuk);
                                                echo date_format($date, 'd/m/Y'); ?></td>
                                            <td><?php $date = date_create($sm->tanggal_diterima);
                                                echo date_format($date, 'd/m/Y'); ?></td>
                                            <td><?= $sm->keterangan; ?></td>
                                            <td><a href="<?php if ($sm->berkas_suratmasuk != "") {
                                                                echo base_url('suratmasuk/download/' . $sm->id_suratmasuk);
                                                            } elseif ($sm->berkas_suratmasuk == "") {
                                                                echo 'javascript:;';
                                                            }  ?>" class="text-success"><i class="fas fa-download"></i></a></i></a></td>
                                            <?php if ($user == 'superadmin') {
                                            ?>
                                                <td>
                                                    <a href="<?= base_url('suratmasuk/edit/' . $sm->id_suratmasuk) ?>"><span class="badge badge-primary d-block">edit</span></a>
                                                    <br>
                                                    <a href="<?= base_url('suratmasuk/disposisi/' . $sm->id_suratmasuk) ?>"><span class="badge badge-warning d-block">diposisi</span></a>
                                                    <br>
                                                    <a href="<?= base_url('suratmasuk/delete/' . $sm->id_suratmasuk) ?>" onclick="return confirm('Hapus data ini?')"><span class="badge badge-danger d-block">Hapus</span></a>
                                                </td>
                                            <?php }
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
        <!-- modal tambah -->


        <div class="modal fade" id="tambah_suratmasuk">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo form_open_multipart('suratmasuk/store');
                        ?>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>No. Surat</label>
                                    <?php $today = date('d,m,Y');
                                    $pecah = explode(',', $today);
                                    $bulan = $pecah[1];
                                    $tahun = $pecah[2]; ?>
                                    <input type="text" name="no_suratmasuk" class="form-control" value="<?php echo 'SM/' .  $tahun . '/' . $bulan . '/' . uniqid(); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Judul Surat Masuk</label>
                                    <input type="text" name="judul_suratmasuk" class="form-control" placeholder="Judul Surat">
                                </div>
                                <div class="form-group">
                                    <label>Asal Surat</label>
                                    <input type="text" name="asal_surat" class="form-control" placeholder="Asal Surat" required="">
                                </div>
                                <div class="form-group">
                                    <label>Dokumen surat</label>
                                    <div class="input-group">
                                        <div class="custom-file">s
                                            <input type="file" name="berkas_suratmasuk" class="custom-file-input">
                                            <label class="custom-file-label">Pilih dokumen</label>
                                        </div>
                                    </div>
                                    <small class="text-danger">Dokumen surat, bisa berupa doc, docx, pdf, jpg dan png.</small>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Tanggal Masuk:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_masuk" value="<?php echo date('Y-m-d') ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Diterima:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_diterima" value="<?php echo date('Y-m-d') ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Index Surat</label>
                                    <select class="form-control" name="id_indeks">
                                        <?php
                                        $allindeks = $this->db->get('indeks')->result();
                                        foreach ($allindeks as $i) : ?>
                                            <option value="<?php echo $i->id_indeks; ?>">
                                                <?php echo strtoupper($i->judul_indeks); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
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

        <!-- Footer -->
        <?php $this->load->view('templates/copyright') ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>