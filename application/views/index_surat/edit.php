<div id="wrapper">

    <?php $this->load->view('templates/sidebar'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div class="content">
            <?php $this->load->view('templates/topbar'); ?>
            <div class="container">

                <h1 class="h3 mb-4 text-gray-800">Edit data ini</h1>

                <div class="card mb-3" style="max-width: 600px;">
                    <div class="card-body">
                        <?php
                        echo form_open_multipart('indexsurat/update');
                        ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body">
                                    <input type="hidden" name="id" value="<?= $indeks->id_indeks ?>">
                                    <div class="form-group"><label for="kode_indeks">Kode</label><input id="kode_indeks" name="kode_indeks" type="text" value="<?= $indeks->kode_indeks ?>" class="form-control"></div>
                                    <div class="form-group"><label for="judul_indeks">Judul Indeks</label><input id="judul_indeks" name="judul_indeks" type="text" class="form-control" value="<?= $indeks->judul_indeks ?>"></div>
                                    <div class="form-group"><label for="detail">Detail</label><textarea id="detail" name="detail" class="form-control"><?= $indeks->detail ?></textarea></div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center"><a href="<?= base_url('indexsurat') ?>" class="btn btn-secondary px-3">BATAL</a><button type="submit" class="btn btn-primary px-3 ml-3">UBAH</button></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>