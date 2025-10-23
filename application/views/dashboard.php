<?php $this->load->view('head'); ?>
<!-- Main Content -->
<div class="container-fluid my-4">
    <!-- Dashboard Section -->
    <section id="dashboard" class="page-section">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold">Dashboard</h2>
                <p class="text-muted">Selamat datang di sistem absensi kebersihan pesantren</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="fw-bold fs-5" id="currentDate">
                    <!-- Tanggal akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>

        <!-- Komplek Info -->
        <!-- <div class="row mb-4">
                <div class="col-12">
                    <div class="card bg-light">
                        <div class="card-body py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold">Komplek Terpilih:</span>
                                    <span id="selectedKomplek" class="ms-2 badge bg-primary">Komplek A</span>
                                </div>
                                <div>
                                    <span class="fw-bold">Tanggal:</span>
                                    <span id="selectedDate" class="ms-2">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        <!-- Tombol Absensi -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <i class="bi bi-sun fs-1 text-warning mb-3"></i>
                        <h5 class="card-title">Absensi Pagi</h5>
                        <p class="card-text">Catat kehadiran kebersihan pagi hari</p>
                        <a href="<?= base_url('absensi/input/pagi') ?>" class="btn btn-primary mt-auto">Buka Absensi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <i class="bi bi-moon fs-1 text-primary mb-3"></i>
                        <h5 class="card-title">Absensi Sore</h5>
                        <p class="card-text">Catat kehadiran kebersihan sore hari</p>
                        <a href="<?= base_url('absensi/input/sore') ?>" class="btn btn-primary mt-auto">Buka Absensi</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Ringkas -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Sudah Buang Sampah (Pagi)</h5>
                                <h4 class="text-success" id=""><?= $pagi->sudah . '/' . $pagi->sudah + $pagi->belum ?> kamar</h4>
                            </div>
                            <i class="bi bi-sun-fill text-warning fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Sudah Buang Sampah (Sore)</h5>
                                <h4 class="text-success" id=""><?= $sore->sudah . '/' . $sore->sudah + $sore->belum ?> kamar</h4>
                            </div>
                            <i class="bi bi-moon-fill text-primary fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<?php $this->load->view('foot'); ?>