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

        <!-- WA Sender -->
        <div class="card mb-4">
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
        <!-- WA Sender -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <h4 class="text-muted">Setting Waktu Pengiriman</h4>
                        <small class="text-danger">Setting waktu harus kelipatan 5 menit. Misal 07.35, 16:30</small>
                        <form action="<?= base_url('setting/setKiriman') ?>" method="post">
                            <div class="row mb-3">
                                <label for="" class="col-sm-4 col-form-label">Jam Pagi</label>
                                <div class="col-sm-8">
                                    <input type="time" name="pagi" class="form-control" value="<?= $w_pagi ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-4 col-form-label">Jam Sore</label>
                                <div class="col-sm-8">
                                    <input type="time" name="sore" class="form-control" value="<?= $w_sore ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Group Receiver -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-muted mb-0">List Group Penerima</h4>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="addGroup">Tambah Group</button>
                        </div>
                        <ul>
                            <?php
                            if ($groups) {
                                foreach ($groups as $group): ?>
                                    <li><?= $group->nama ?> <a class="text-danger" onclick="return confirm('Yakin akan dihapus?')" href="<?= base_url('setting/delGroup/' . $group->id) ?>"><i class="bi bi-trash"></i></a></li>
                            <?php endforeach;
                            } else {
                                echo "<center>Tidak ada data</center>";
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Group</h1>
                <button type="button" class="btn-close done" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hovered table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Group</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody id="isiGroups">
                            <tr>
                                <td colspan="3" class="text-center text-muted">Proses menampilkan data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary done" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('foot'); ?>
<script>
    $('#addGroup').on('click', function() {
        $.ajax({
            url: '<?= base_url() ?>setting/groups',
            type: 'get',
            dataType: 'json',
            success: function(res) {
                const tbody = $('#isiGroups');
                tbody.empty(); // Kosongkan dulu

                if (res.results && res.results.length > 0) {
                    res.results.forEach((item, index) => {
                        const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.subject}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary pilihGroupBtn" 
                                        data-id="${item.id}" data-nama="${item.subject}">
                                        <i class="bi bi-check-lg"></i> Pilih
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                } else {
                    tbody.html(`
                        <tr>
                            <td colspan="3" class="text-center text-muted">Tidak ada data group</td>
                        </tr>
                    `);
                }

                // Event untuk tombol pilih
                $(document).on('click', '.pilihGroupBtn', function() {
                    const id = $(this).data('id');
                    const nama = $(this).data('nama');
                    $.ajax({
                        url: '<?= base_url() ?>setting/addGroup',
                        type: 'post',
                        data: {
                            id: id,
                            nama: nama
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status == 'success') {
                                showAlert(res.message, 'success', 2000);
                            } else {
                                showAlert(res.message, 'error', 2000);
                            }
                        },
                        error: function(err) {
                            console.error(err);
                        }
                    })
                });
            },
            error: function(err) {
                console.error(err);
                $('#isiGroups').html(`
                    <tr>
                        <td colspan="3" class="text-center text-danger">Gagal memuat data</td>
                    </tr>
                `);
            }
        })
    })
    $(document).on('click', '.done', function() {
        window.location.reload()
    })
</script>