<?php $this->load->view('head'); ?>
<!-- Main Content -->
<div class="container-fluid my-4">

    <!-- Absensi Section -->
    <section id="absensi" class="page-section">
        <div class="row mb-4 align-items-center justify-content-between">
            <div class="col-md-8 col-12 mb-3 mb-md-0">
                <h2 class="fw-bold">Rekap Kebersihan</h2>
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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Pagi</th>
                                <th scope="col">Sore</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= $row['pagi'] ?>%</td>
                                    <td><?= $row['sore'] ?>%</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">kirim</button>
                                        <button class="btn btn-sm btn-warning">edit</button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>
<?php $this->load->view('foot'); ?>