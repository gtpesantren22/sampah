<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Absensi Kebersihan Pesantren</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #2196F3;
            --accent-color: #FF9800;
            --success-color: #8BC34A;
            --warning-color: #FFC107;
            --text-color: #2C3E50;
            --light-bg: #F8F9FA;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }

        .login-container {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            position: relative;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--success-color) 100%);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0) 70%);
            animation: rotate 10s linear infinite;
        }

        .login-header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--white);
            position: relative;
            font-size: 2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .login-header p {
            color: var(--white);
            opacity: 0.9;
            margin-bottom: 0;
            position: relative;
            font-size: 1.1rem;
        }

        .login-body {
            padding: 2.5rem 2rem;
            background: var(--white);
        }

        .form-control {
            border-radius: 12px;
            padding: 1rem 1.25rem;
            border: 2px solid #E9ECEF;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1rem;
            background: var(--white);
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.3rem rgba(33, 150, 243, 0.15);
            transform: translateY(-2px);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border: none;
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(33, 150, 243, 0.4);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .login-footer {
            text-align: center;
            padding: 1.5rem 2rem;
            background: var(--light-bg);
            color: #6C757D;
            font-size: 0.9rem;
            border-top: 1px solid #E9ECEF;
        }

        .input-group-text {
            background: var(--white);
            border: 2px solid #E9ECEF;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: var(--secondary-color);
            padding: 1rem 1.25rem;
            font-size: 1.1rem;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .input-group .form-control:focus {
            border-left: none;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .form-check-input:checked {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .form-check-input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
        }

        .forgot-password {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .forgot-password:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .app-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--white);
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--warning-color) 100%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
        }

        /* Animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            33% {
                transform: translateY(-10px) rotate(2deg);
            }

            66% {
                transform: translateY(5px) rotate(-2deg);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .login-container {
            animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .app-icon {
            animation: float 4s ease-in-out infinite;
        }

        /* Dekorasi tambahan */
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            background: var(--accent-color);
            width: 120px;
            height: 120px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .shape-2 {
            background: var(--warning-color);
            width: 80px;
            height: 80px;
            bottom: 15%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape-3 {
            background: var(--success-color);
            width: 60px;
            height: 60px;
            top: 40%;
            right: 15%;
            animation-delay: 4s;
        }

        /* Responsif */
        @media (max-width: 576px) {
            .login-container {
                max-width: 100%;
                border-radius: 15px;
            }

            .login-header,
            .login-body {
                padding: 2rem 1.5rem;
            }

            .login-header h1 {
                font-size: 1.75rem;
            }

            .shape {
                display: none;
            }
        }

        /* Alert Custom */
        .custom-alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #4CAF50 100%);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #F44336 0%, #E53935 100%);
            color: white;
        }

        /* Label Form */
        .form-label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        /* Link Register */
        .register-link {
            color: var(--secondary-color);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }

        .register-link:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Dekorasi background -->
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <!-- <i class="bi bi-house-heart-fill app-icon"></i> -->
            <h1>Absensi Kebersihan</h1>
            <p>Pesantren Modern</p>
        </div>

        <div class="login-body">
            <form id="loginForm">
                <div class="mb-4">
                    <label for="username" class="form-label">
                        <i class="bi bi-person me-2"></i>Username
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan username Anda" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">
                        <i class="bi bi-key me-2"></i>Password
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan password Anda" required>
                    </div>
                </div>

                <div class="remember-forgot">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">
                            Ingat saya
                        </label>
                    </div>
                    <a href="#" class="forgot-password">
                        <i class="bi bi-question-circle me-1"></i>Lupa password?
                    </a>
                </div>

                <button type="submit" class="btn btn-login w-100 mb-4">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Sistem
                </button>
            </form>
        </div>

        <div class="login-footer">
            <div class="row align-items-center">
                <div class="col">
                    &copy; 2023 Absensi Kebersihan Pesantren
                </div>
                <div class="col-auto">
                    <span class="badge bg-success">v2.0</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');

            // Cek apakah ada data login yang tersimpan
            const savedUsername = localStorage.getItem('savedUsername');
            const rememberMe = localStorage.getItem('rememberMe') === 'true';

            if (savedUsername && rememberMe) {
                document.getElementById('username').value = savedUsername;
                document.getElementById('rememberMe').checked = true;
            }

            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const rememberMe = document.getElementById('rememberMe').checked;

                // Validasi sederhana
                if (!username || !password) {
                    showAlert('Username dan password harus diisi!', 'error');
                    return;
                }

                if (username.length < 3) {
                    showAlert('Username harus minimal 3 karakter!', 'error');
                    return;
                }

                if (password.length < 6) {
                    showAlert('Password harus minimal 6 karakter!', 'error');
                    return;
                }

                // Simpan username jika "Ingat saya" dicentang
                if (rememberMe) {
                    localStorage.setItem('savedUsername', username);
                    localStorage.setItem('rememberMe', 'true');
                } else {
                    localStorage.removeItem('savedUsername');
                    localStorage.removeItem('rememberMe');
                }

                // Simulasi proses login
                simulateLogin(username, password);
            });

            function simulateLogin(username, password) {
                const submitBtn = loginForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner me-2"></i> Memproses Login...';
                submitBtn.disabled = true;

                $.ajax({
                    url: '<?= site_url("auth/login_action") ?>', // arahkan ke controller Auth
                    method: 'POST',
                    data: {
                        username: username,
                        password: password
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            showAlert(response.message, 'success');

                            // Simpan status login di localStorage (opsional)
                            localStorage.setItem('isLoggedIn', 'true');
                            localStorage.setItem('currentUser', username);

                            // Redirect ke dashboard setelah delay
                            setTimeout(() => {
                                window.location.href = '<?= site_url("dashboard") ?>';
                            }, 1500);
                        } else {
                            showAlert(response.message, 'error');
                            $('#password').val('');
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }
                    },
                    error: function(xhr, status, error) {
                        showAlert('Terjadi kesalahan koneksi ke server.', 'error');
                        console.error(error);
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                });
            }

            function showAlert(message, type) {
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
                }, 4000);
            }

            // Tambahkan style untuk spinner dan animasi
            const style = document.createElement('style');
            style.textContent = `
                .spinner {
                    animation: spin 1s linear infinite;
                }
                
                @keyframes spin {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }
                
                @keyframes slideInRight {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                
                @keyframes slideOutRight {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>

</html>