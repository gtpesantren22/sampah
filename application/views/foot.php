<!-- Footer -->
<footer class="bg-light py-4 mt-auto">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">&copy; 2025 Absensi Kebersihan Pesantren</p>
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

    function showAlert(message, type, time) {
        // Hapus alert sebelumnya jika ada
        const existingAlert = document.querySelector('.custom-alert');
        if (existingAlert) {
            existingAlert.remove();
        }

        // Buat alert baru
        const alert = document.createElement('div');
        alert.className = `custom-alert alert alert-${type === 'error' ? 'danger' : 'success'} position-fixed`;
        alert.style.cssText = `
                    top: 30px;
                    right: 30px;
                    z-index: 9999;
                    min-width: 350px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                    border: none;
                    border-radius: 12px;
                    padding: 1rem 1.5rem;
                    animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                `;
        alert.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="bi ${type === 'error' ? 'bi-exclamation-triangle-fill' : 'bi-check-circle-fill'} me-3 fs-5"></i>
                        <div class="flex-grow-1">
                            <strong class="d-block">${type === 'error' ? 'Error' : 'Sukses'}</strong>
                            <span class="d-block mt-1">${message}</span>
                        </div>
                        <button type="button" class="btn-close btn-close-white" onclick="this.parentElement.parentElement.remove()"></button>
                    </div>
                `;

        document.body.appendChild(alert);

        // Hapus alert setelah 4 detik
        setTimeout(function() {
            if (alert.parentNode) {
                alert.style.animation = 'slideOutRight 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                setTimeout(function() {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 400);
            }
        }, time);
    }
</script>
</body>

</html>