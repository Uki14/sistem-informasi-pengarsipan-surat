<div id="wrapper">

    <?php $this->load->view('templates/sidebar'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div class="content">
            <?php $this->load->view('templates/topbar'); ?>
            <div class="container">

                <h1 class="h3 mb-4 text-gray-800">Edit data ini</h1>

                <div class="card mb-3">
                    <div class="card-body">
                        <?php
                        echo form_open_multipart('suratkeluar/update');
                        ?>
                        <div class="row">
                            <input type="hidden" name="id" value="<?= $suratkeluar->id_suratkeluar ?>">
                            <div class="col-md">
                                <input type="hidden" name="id_suratkeluar" value="<?= $suratkeluar->id_suratkeluar ?>">
                                <div class="form-group">
                                    <label>No. Surat</label>
                                    <?php $today = date('d,m,Y');
                                    $pecah = explode(',', $today);
                                    $bulan = $pecah[1];
                                    $tahun = $pecah[2]; ?>
                                    <input type="text" name="no_suratkeluar" class="form-control" value="<?= $suratkeluar->no_suratkeluar ?>">
                                </div>
                                <div class="form-group">
                                    <label>Judul Surat Keluar</label>
                                    <input type="text" name="judul_suratkeluar" class="form-control" value="<?= $suratkeluar->judul_suratkeluar ?>" placeholder="Judul Surat">
                                </div>
                                <div class="form-group">
                                    <label>Tujuan</label>
                                    <input type="text" name="tujuan" class="form-control" value="<?= $suratkeluar->tujuan ?>" placeholder="Tujuan">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Tanggal Keluar:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_keluar" class="form-control" value="<?= $suratkeluar->tanggal_keluar ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?php echo date('Y-m-d') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Indeks Surat</label>
                                    <select class="form-control" name="id_indeks">
                                        <?php
                                        $indeks_by_surat = $this->db->get_where('indeks', ['id_indeks' => $suratkeluar->id_indeks])->row();
                                        ?>
                                        <option value="<?= $suratkeluar->id_indeks ?>">
                                            <?= strtoupper('-- ' . $indeks_by_surat->judul_indeks . ' --') ?></option>
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
                                            <label class="custom-file-label" for="exampleInputFile"><?= $suratkeluar->berkas_suratkeluar ?></label>
                                        </div>
                                    </div>
                                    <small class="text-danger">Dokumen surat, bisa berupa doc, docx, pdf, jpg dan png.</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="keterangan" placeholder="Keterangan"><?= $suratkeluar->keterangan ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-center"><a href="<?= base_url('suratmasuk') ?>" class="btn btn-secondary px-3">BATAL</a><button type="submit" class="btn btn-primary px-3 ml-3">UBAH</button></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>