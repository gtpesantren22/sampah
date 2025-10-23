<!-- Footer -->
<footer class="bg-light py-4 mt-auto">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">&copy; 2023 Absensi Kebersihan Pesantren</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0">Sistem pencatatan kebersihan kamar pesantren</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Set tanggal hari ini
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];
        document.getElementById('currentDate').textContent = formatDate(today);
        // document.getElementById('selectedDate').textContent = formatDate(today);
        document.getElementById('rekapDate').value = formattedDate;
    });



    // Fungsi untuk memformat tanggal
    function formatDate(date) {
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return date.toLocaleDateString('id-ID', options);
    }
</script>
</body>

</html>