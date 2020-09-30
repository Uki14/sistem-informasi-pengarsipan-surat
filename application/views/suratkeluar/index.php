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
                <h1 class="h3 mb-4 text-gray-800">Surat Keluar</h1>
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
                                    <button class="btn btn-primary btn-flat btn-block" id="tambah" data-toggle="modal" data-target="#tambah_suratkeluar"><i class="fas fa-plus"></i> Tambah data </button>
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
                                        <th>Nomor Surat</th>
                                        <th>Judul Surat</th>
                                        <th>Indeks</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Keterangan</th>
                                        <th>Berkas</th>
                                        <?php if ($user == 'superadmin') {
                                        ?>
                                            <th>Aksi</th>
                                        <?php  }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($suratkeluar as $sk) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $sk->no_suratkeluar; ?></td>
                                            <td><?= $sk->judul_suratkeluar; ?></td>
                                            <td><?php
                                                $indeks = $this->db->get_where('indeks', ['id_indeks' => $sk->id_indeks])->row_array();
                                                echo $indeks['judul_indeks'];
                                                ?></td>
                                            <td><?= $sk->tujuan; ?></td>
                                            <td><?php $date = date_create($sk->tanggal_keluar);
                                                echo date_format($date, 'd/m/Y'); ?></td>
                                            <td><?= $sk->keterangan; ?></td>
                                            <td><a href="<?php if ($sk->berkas_suratkeluar != "") {
                                                                echo base_url('suratkeluar/download/' . $sk->id_suratkeluar);
                                                            } elseif ($sk->berkas_suratkeluar == "") {
                                                                echo 'javascript:;';
                                                            }  ?>" class="text-success"><i class="fas fa-download"></i></a></i></a>
                                            </td>
                                            <?php if ($user == 'superadmin') {
                                            ?>
                                                <td>
                                                    <a href="<?= base_url('suratkeluar/edit/' . $sk->id_suratkeluar) ?>" class="badge badge-primary d-block">edit</a>
                                                    <br>
                                                    <a href="<?= base_url('suratkeluar/delete/' . $sk->id_suratkeluar) ?>" onclick="return confirm('Hapus data ini?')" class="badge badge-danger d-block">hapus</a>
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
        <?php $this->load->view('templates/copyright') ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<div class="modal fade" id="tambah_suratkeluar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <form role="form" action="<?= base_url('suratkeluar/store') ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No. Surat</label>
                                        <?php
                                        $last_row = $this->db->select('id_suratkeluar')->order_by('id_suratkeluar', "desc")->limit(1)->get('suratkeluar')->row();

                                        $last_row = $last_row == null ? 0 : $last_row->id_suratkeluar;

                                        $today = date('d,m,Y');
                                        $pecah = explode(',', $today);
                                        $bulan = $pecah[1];
                                        $tahun = $pecah[2]; ?>
                                        <input type="text" name="no_suratkeluar" class="form-control" value="SK/H-<?php echo $bulan . '/' . $tahun . '/' . ($last_row + 1); ?>" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Judul Surat Keluar</label>
                                        <input type="text" name="judul_suratkeluar" class="form-control" placeholder="Judul Surat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tujuan</label>
                                        <input type="text" name="tujuan" class="form-control" placeholder="Tujuan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Keluar:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" name="tanggal_keluar" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?php echo date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Surat</label>
                                        <select class="form-control" name="id_indeks">
                                            <?php
                                            $indeks = $this->db->get('indeks')->result();

                                            foreach ($indeks as $i) : ?>
                                                <option value="<?php echo $i->id_indeks; ?>">
                                                    <?php echo strtoupper($i->judul_indeks); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Dokumen surat</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="berkas_suratkeluar" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Pilih dokumen</label>
                                            </div>
                                        </div>
                                        <small class="text-danger">Dokumen surat, bisa berupa doc, docx, pdf, jpg dan png.</small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                </p>
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