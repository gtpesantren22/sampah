<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Kebersihan Pesantren</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- html2canvas (untuk screenshot) -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <style>
        :root {
            --primary-color: #a8e6cf;
            --secondary-color: #f7f7f7;
            --text-color: #333333;
            --light-gray: #e9ecef;
            --success-light: #d4edda;
            --danger-light: #f8d7da;
        }

        body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container-fluid {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: none;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--text-color);
        }

        .btn-primary:hover {
            background-color: #8cd8bb;
            border-color: #8cd8bb;
        }

        .status-sudah {
            background-color: var(--success-light);
            color: #155724;
        }

        .status-belum {
            background-color: var(--danger-light);
            color: #721c24;
        }

        .chart-container {
            position: relative;
            height: 200px;
            width: 100%;
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 500;
        }

        .table-responsive {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table th {
            background-color: var(--primary-color);
        }

        /* Mode Gelap */
        .dark-mode {
            background-color: #1a1a1a;
            color: #f0f0f0;
        }

        .dark-mode .navbar {
            background-color: #2d2d2d;
        }

        .dark-mode .card {
            background-color: #2d2d2d;
            color: #f0f0f0;
        }

        .dark-mode .table {
            color: #f0f0f0;
        }

        .dark-mode .table th {
            background-color: #3d3d3d;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-house-heart-fill me-2"></i>Absensi Kebersihan
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-page="dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="rekapDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Rekap
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="rekapDropdown">
                            <li>
                                <a class="dropdown-item" href="<?= base_url('rekap') ?>" data-page="rekap-harian">Rekap Harian</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('rekap/bulanan') ?>" data-page="rekap-bulanan">Rekap Bulanan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('setting') ?>" data-page="rekap-setting">Pengaturan</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <!-- Dropdown Pilih Komplek -->

                    <!-- Mode Gelap/Terang -->
                    <!-- <button class="btn btn-outline-secondary me-2" id="darkModeToggle">
                        <i class="bi bi-moon"></i>
                    </button> -->

                    <!-- User Info -->
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>