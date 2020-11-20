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
                        echo form_open_multipart('suratmasuk/update');
                        ?>
                        <div class="row">
                            <input type="hidden" name="id" value="<?= $suratmasuk['id_suratmasuk'] ?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. Surat</label>
                                    <?php $today = date('d,m,Y');
                                    $pecah = explode(',', $today);
                                    $bulan = $pecah[1];
                                    $tahun = $pecah[2]; ?>
                                    <input type="text" name="no_suratmasuk" class="form-control" value="<?php echo $suratmasuk['no_suratmasuk'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Judul Surat Masuk</label>
                                    <input type="text" name="judul_suratmasuk" class="form-control" placeholder="Judul Surat" required value="<?= $suratmasuk['judul_suratmasuk'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Asal Surat</label>
                                    <input type="text" name="asal_surat" class="form-control" placeholder="Asal Surat" required value="<?= $suratmasuk['asal_surat'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Dokumen surat</label>
                                    <div class="input-group">
                                        <div class="custom-file">s
                                            <input type="file" name="berkas_suratmasuk" class="custom-file-input">
                                            <label class="custom-file-label"><?= $suratmasuk['berkas_suratmasuk'] ?></label>
                                        </div>
                                    </div>
                                    <small class="text-danger">Dokumen surat, bisa berupa doc, docx, pdf, jpg dan png.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Masuk:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_masuk" value="<?php echo $suratmasuk['tanggal_masuk'] ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Diterima:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_diterima" value="<?php echo $suratmasuk['tanggal_diterima'] ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Index Surat</label>
                                    <select class="form-control" name="id_indeks">
                                        <?php
                                        $id_indeks = $this->db->get_where('indeks', ['id_indeks' => $suratmasuk['id_indeks']])->row_array();
                                        ?>
                                        <option value="<?= $suratmasuk['id_indeks'] ?>">-- <?= strtoupper($id_indeks['judul_indeks']) ?> --</option>
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
                                    <textarea class="form-control" name="keterangan" placeholder="Keterangan">
                                        <?= $suratmasuk['keterangan'] ?>
                                    </textarea>
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