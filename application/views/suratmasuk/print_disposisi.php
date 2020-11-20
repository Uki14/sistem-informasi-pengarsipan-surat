<body onload="window.print()">
    <div class="col-12 table-responsive" style="height: 100vh; max-width: 540px">
        <table class="table table-white bg-white table-bordered" width="60%" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo base_url('assets/') ?>img/logo.jpg" alt="logo.jpg" class="img-fluid" style="width: 50px; height: 50px">
                            <div class="text-center ml-3">
                                <h5>Lembar Disposisi<br>SMK DAREL HIKMAH PEKANBARU</h5>
                                <span class="text-muted">Jl. Manyar Sakti, No. 12, Simpang Baru, Pekanbaru</span>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Nomor</b></td>
                    <td><?php echo $suratmasuk['no_suratmasuk']; ?></td>
                    <td><b>Diteruskan kepada</b></td>
                </tr>
                <tr>
                    <td><b>Perihal</b></td>
                    <td><?php echo $suratmasuk['judul_suratmasuk']; ?></td>
                    <td><?php echo $suratmasuk['tujuan']; ?></td>
                </tr>
                <tr>
                    <td><b>Tanggal</b></td>
                    <td><?php $tanggal = date_create($suratmasuk['tanggal_masuk']); ?><?php echo date_format($tanggal, "d - m - Y"); ?></td>
                    <td><b>Catatan</b></td>
                </tr>
                <tr>
                    <td><b>Asal</b></td>
                    <td><?php echo $suratmasuk['asal_surat']; ?></td>
                    <td><?php echo $suratmasuk['catatan']; ?></td>
                </tr>
                <tr>
                    <td rowspan="4" colspan="3"><b>Instruksi/Informasi</b><br>
                        <textarea name="" class="form-control" id="" cols="30" rows="10"><?php echo $suratmasuk['instruksi']; ?></textarea>
                        <br>
                        <ol>
                            <li><strong>Kepada bawahan "Instruksi" dan coret "Informasi"</strong></li>
                            <li><strong>Kepada atasan "Informasi" dan coret "Instruksi"</strong></li>
                        </ol>
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
            </tbody>
        </table>
    </div>
</body>