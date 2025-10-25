<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kebersihan Kamar</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #a8e6cf;
            --secondary-color: #f7f7f7;
            --text-color: #333333;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a8e6cf 0%, #dcedc1 100%);
            color: var(--text-color);
            min-height: 100vh;
            padding: 20px;
        }

        .report-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .report-header {
            background: linear-gradient(135deg, #2c7744 0%, #4CAF50 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .report-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .report-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .report-date {
            font-size: 1.1rem;
            opacity: 0.8;
            font-weight: 500;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-left: 5px solid var(--success-color);
        }

        .stats-card.danger {
            border-left-color: var(--danger-color);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 1rem;
            color: #666;
            font-weight: 500;
        }

        .table-container {
            padding: 0 20px 30px 20px;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .table thead th {
            background: linear-gradient(135deg, #2c7744 0%, #4CAF50 100%);
            color: white;
            font-weight: 600;
            padding: 15px;
            text-align: center;
            border: none;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            text-align: center;
            border-color: #e9ecef;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e8f5e8;
        }

        .status-badge {
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .status-sudah {
            background-color: #e8f5e8;
            color: var(--success-color);
            border: 1px solid #c8e6c9;
        }

        .status-belum {
            background-color: #ffebee;
            color: var(--danger-color);
            border: 1px solid #ffcdd2;
        }

        .kamar-name {
            font-weight: 500;
            color: #333;
        }

        .summary-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px;
        }

        .summary-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c7744;
        }

        .progress {
            height: 12px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .progress-bar {
            border-radius: 10px;
        }

        .footer-note {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 0.9rem;
            border-top: 1px solid #e9ecef;
            margin-top: 5px;
        }

        /* Icon styling */
        .bi-check-circle-fill {
            color: var(--success-color);
        }

        .bi-x-circle-fill {
            color: var(--danger-color);
        }
    </style>
</head>

<body>
    <div class="report-container">
        <div id="capture">
            <!-- Header -->
            <div class="report-header">
                <h1 class="report-title">Laporan Kebersihan Kamar (<?= $waktu ?>)</h1>
                <div class="report-subtitle">Kamar yang Sudah/Belum Membuang Sampah</div>
                <div class="report-date">Hari <?= tanggalIndonesia($tanggal) ?></div>
            </div>

            <!-- Stats Cards -->
            <div class="row mx-0">
                <div class="col-md-6 px-2">
                    <div class="stats-card">
                        <div class="stats-number text-success"><?= $sudah ?></div>
                        <div class="stats-label">Kamar Sudah Buang Sampah</div>
                    </div>
                </div>
                <div class="col-md-6 px-2">
                    <div class="stats-card danger">
                        <div class="stats-number text-danger"><?= $belum ?></div>
                        <div class="stats-label">Kamar Belum Buang Sampah</div>
                    </div>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="summary-section">
                <div class="summary-title">Ringkasan Kebersihan</div>
                <div class="row">
                    <?php
                    $psrnPagi = round($pagi->sudah / ($pagi->sudah + $pagi->belum) * 100, 1);
                    $psrnSore = round($sore->sudah / ($sore->sudah + $sore->belum) * 100, 1);
                    ?>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Kebersihan Pagi</span>
                            <span><?= $psrnPagi ?>%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $psrnPagi ?>%"></div>
                        </div>
                        <small class="text-muted"><?= $pagi->sudah ?> dari <?= $pagi->sudah + $pagi->belum ?> kamar sudah bersih</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Kebersihan Sore</span>
                            <span><?= $psrnSore ?>%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $psrnSore ?>%"></div>
                        </div>
                        <small class="text-muted"><?= $sore->sudah ?> dari <?= $sore->sudah + $sore->belum ?> kamar sudah bersih</small>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="35%">Kamar</th>
                            <th width="25%">Pagi</th>
                            <th width="25%">Sore</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="kamar-name"><?= $row->nama ?></td>
                                <td>
                                    <?php
                                    if ($row->pagi == 1) {
                                        echo "<span class='status-badge status-sudah'><i class='bi bi-check-circle-fill me-1'></i> Sudah</span>";
                                    } else {
                                        echo "<span class='status-badge status-belum'><i class='bi bi-x-circle-fill me-1'></i> Belum</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row->sore == 1) {
                                        echo "<span class='status-badge status-sudah'><i class='bi bi-check-circle-fill me-1'></i> Sudah</span>";
                                    } else {
                                        echo "<span class='status-badge status-belum'><i class='bi bi-x-circle-fill me-1'></i> Belum</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <!-- Footer Note -->
            <div class="footer-note">
                <i class="bi bi-info-circle me-1"></i> Laporan ini dihasilkan otomatis pada <?= tanggalIndonesia(date('Y-m-d')).', '. date('H:i') ?> WIB
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>