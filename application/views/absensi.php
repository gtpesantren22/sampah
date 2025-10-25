<?php $this->load->view('head'); ?>
<!-- Main Content -->
<div class="container-fluid my-4">

    <!-- Absensi Section -->
    <section id="absensi" class="page-section">
        <div class="row mb-4 align-items-center justify-content-between">
            <div class="col-md-8 col-12 mb-3 mb-md-0">
                <h2 class="fw-bold">Absensi Kebersihan</h2>
                <p class="text-muted" id="absensiSubtitle">Absensi <?= $waktu ?> - Komplek ...</p>
            </div>

            <div class="col-md-4 col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-end gap-2">
                    <div class="dropdown w-100 w-md-auto">
                        <button class="btn btn-outline-secondary w-100 w-md-auto dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-building me-1"></i> Pilih Komplek
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item show-kamar" href="#" data-komplek="Putra">Putra</a></li>
                            <li><a class="dropdown-item show-kamar" href="#" data-komplek="Putri">Putri</a></li>
                        </ul>
                    </div>

                    <a href="<?= base_url('absensi/reloadKamar/' . $waktu) ?>" class="btn btn-success w-100 w-md-auto">
                        <i class="bi bi-building-add me-1"></i> Refreh Data Kamar
                    </a>
                    <a href="<?= base_url() ?>" class="btn btn-info w-100 w-md-auto">
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
                                <th scope="col">Nama Kamar</th>
                                <th scope="col">Pagi</th>
                                <th scope="col">Sore</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="absensiTableBody">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>
<?php $this->load->view('foot'); ?>

<script>
    $('.show-kamar').on('click', function() {
        var komplek = $(this).data('komplek')
        $('#absensiSubtitle').text('Absensi <?= $waktu ?> - Komplek ' + komplek)
        loadkamar('<?= $tanggal ?>', komplek)
    })

    function loadkamar(tanggal, komplek) {
        $.ajax({
            url: "<?= base_url('absensi/getKamar') ?>",
            type: 'post',
            data: {
                tanggal: tanggal,
                komplek_id: komplek
            },
            dataType: 'json',
            success: function(res) {
                const tbody = document.getElementById('absensiTableBody');
                tbody.innerHTML = '';
                if (res.data && res.data.length > 0) {
                    res.data.forEach((kamar, index) => {
                        const row = document.createElement('tr');

                        const pagiStatus = kamar.pagi == 1 ? true : false;
                        const soreStatus = kamar.sore == 1 ? true : false;
                        const isSudah = '<?= $waktu ?>' == 'pagi' ? pagiStatus : soreStatus;

                        row.innerHTML = `
                            <td>${index+1}</td>
                            <td>${kamar.nama}</td>
                            <td>
                                <span class="badge ${getStatusBadgeClass(pagiStatus)}">
                                    ${getStatusText(pagiStatus)}
                                </span>
                            </td>
                            <td>
                                <span class="badge ${getStatusBadgeClass(soreStatus)}">
                                    ${getStatusText(soreStatus)}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-success ${isSudah ? 'active' : ''}" 
                                        data-action="sudah" data-waktu="<?= $waktu ?>" data-kamar="${kamar.id}">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger ${!isSudah ? 'active' : ''}" 
                                        data-action="belum" data-waktu="<?= $waktu ?>" data-kamar="${kamar.id}">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="5" class="text-center text-muted">Tidak ada data kamar</td>`;
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        })
    }
    // Fungsi untuk mendapatkan kelas badge berdasarkan status
    function getStatusBadgeClass(status) {
        return status ? 'status-sudah' : 'status-belum';
    }

    // Fungsi untuk mendapatkan teks status
    function getStatusText(status) {
        return status ? 'Sudah' : 'Belum';
    }

    $(document).on('click', '.btn[data-action]', function() {
        var kamar = $(this).data('kamar')
        var waktu = $(this).data('waktu')
        var action = $(this).data('action')

        $.ajax({
            url: "<?= base_url('absensi/update') ?>",
            type: 'post',
            data: {
                kamar: kamar,
                waktu: waktu,
                action: action
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == 'ok') {
                    loadkamar('<?= $tanggal ?>', res.komplek)
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
            }
        })
    })
</script>