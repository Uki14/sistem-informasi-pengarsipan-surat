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
                <h1 class="h3 mb-4 text-gray-800">Laporan Surat Keluar</h1>
                <div class="card mb-3" style="max-width: 600px;">
                    <div class="card-body">

                        <form action="<?= base_url('suratkeluar/print_report?filter=indeks') ?>" target="_blank" method="POST">
                            <div class="form-group row">
                                <label for="">Cetak berdasarkan indeks</label>
                                <select name="id_indeks" class="form-control col-10" id="">
                                    <?php
                                    $index = $this->db->get('indeks')->result();
                                    foreach ($index as $i) :
                                    ?>
                                        <option value="<?= $i->id_indeks ?>"><?= $i->judul_indeks ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-sm col-2 btn-success">Cetak</button>
                            </div>
                        </form>

                        <hr>
                        <form action="<?= base_url('suratkeluar/print_report?filter=date_out') ?>" target="_blank" method="POST">
                            <div class="form-group row">
                                <label class="col-12" for="">Cetak berdasarkan tanggal keluar surat</label>
                                <input type="date" required class="form-control col-5" name="first">
                                <input type="date" class="form-control col-5" name="second">
                                <button type="submit" required class="btn btn-sm col-2 btn-success">Cetak</button>
                            </div>
                        </form>
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