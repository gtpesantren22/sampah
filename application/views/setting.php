<?php $this->load->view('head'); ?>
<!-- Main Content -->
<div class="container-fluid my-4">

    <!-- Absensi Section -->
    <section id="absensi" class="page-section">
        <div class="row mb-4 align-items-center justify-content-between">
            <div class="col-md-8 col-12 mb-3 mb-md-0">
                <h2 class="fw-bold">Pengaturan Aplikasi</h2>
            </div>

            <div class="col-md-4 col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-end gap-2">
                    <a href="<?= base_url() ?>" class="btn btn-info w-100 w-md-auto" data-page="dashboard">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabel Absensi -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <h4 class="text-muted">Status WA Pengirim</h4>
                        <?php
                        if ($status == 'SERVICE_OFF') { ?>
                            <b>Status : <?= $status ?></b> <br><br>
                            <button class="btn btn-sm btn-primary" onclick="window.location.href='<?= base_url() ?>/setting/startService'">Mulai Service</button>
                        <?php } else if ($status == 'SERVICE_SCAN') { ?>
                            <b>Status : <?= $status ?></b>
                            <p>Scan QR dibawah ini</p>
                            <img src="<?= $scr['results']['qrString'] ?>" alt="QR Code" style="width:200px; height:200px;"><br>
                            <button class="btn btn-primary" onclick="location.reload()">
                                Refresh QR Code
                            </button> <br><br>
                            <b>Catatan :</b>
                            <ul>
                                <li>Segera lakukan scan, karena QR akan segera berubah</li>
                                <li>Klik Reload QR, jika QR tidak bisa digunakan</li>
                            </ul>
                        <?php } else {
                            echo "<b>Status : $status </b>";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php $this->load->view('foot'); ?>