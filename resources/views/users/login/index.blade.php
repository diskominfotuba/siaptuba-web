<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="theme-color" content="#1E2A5E">
  <title>{{ $title ?? 'SIAP TUBA' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="turbolinks-visit-control" content="reload">

  <meta itemprop="name" content="SIAP TUBA" />
  <meta itemprop="description" content="Sistem Administrasi Pegawai Kabupaten Tulang Bawang" />
  <meta itemprop="image" content="{{ asset('assets/icon/lc_icon_presensi.png') }}" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@" />
  <meta name="twitter:title" content="SIAP TUBA" />
  <meta name="twitter:description" content="Sistem Administrasi Pegawai Kabupaten Tulang Bawang" />
  <meta name="twitter:creator" content="@" />
  
  <meta name="twitter:image" content="{{ asset('assets/icon/lc_icon_presensi.png') }}" />
  
  <meta name="twitter:image:src" content="{{ asset('assets/icon/lc_icon_presensi.png') }}" />
  <meta property="og:title" content="SIAP TUBA" />
  <meta property="og:type" content="Sistem Administrasi Pegawai Kabupaten Tulang Bawang" />
  <meta property="og:url" content="{{ url()->current() }}" />
  <meta property="og:image" content="{{ asset('assets/icon/lc_icon_presensi.png') }}" />
  <meta property="og:description" content="Sistem Administrasi Pegawai Kabupaten Tulang Bawang" />
  <meta property="og:site_name" content="SIAP TUBA" />

  <!-- Favicon Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('icon.png') }}">

  <link rel="stylesheet" href="{{ asset('assets/pegawai/css/style.css') }}">
  <!-- PWA  -->
   <link rel="apple-touch-icon" href="{{ asset('assets/icon/lc_icon_presensi.png') }}">
  <!-- Bootstrap 5 CSS -->
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      max-width: 500px; /* Maksimal width untuk ukuran HP */
      margin: 0 auto; /* Pusatkan tampilan */
      overflow-x: hidden; /* Hindari horizontal scroll */
    }
    .blue-section {
      background-color: #1e2a5e;
      color: white;
      padding: 50px 20px;
      text-align: center;
    }
    .welcome-title {
      font-size: 1.5rem;
      font-weight: bold;
    }
    .welcome-text {
      font-size: 1rem;
    }
    .logo-image {
      width: 100%;
      max-width: 400px;
      margin-top: 20px;
      margin-bottom: -35px;
    }
    .form-container {
      background-color: white;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
      margin-top: -20px;
      padding: 30px 20px;
      position: relative;
      z-index: 1;
    }
    .shortcut-title {
      font-weight: 600;
      margin-bottom: 20px;
      color: #1e2a5e;
    }
    .shortcut-card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 15px;
      text-align: center;
      transition: transform 0.3s ease;
      height: 100%;
    }
    .shortcut-card:hover {
      transform: translateY(-5px);
    }
    .shortcut-icon {
      font-size: 2rem;
      color: #1e2a5e;
      margin-bottom: 10px;
    }
    .shortcut-text {
      font-size: 0.9rem;
      color: #2c3e50;
      font-weight: 500;
    }
    .input-container {
      position: relative;
      margin-bottom: 15px;
    }
    .input-icon {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #1e2a5e;
    }
    .form-control {
      padding-left: 40px;
      height: 50px;
      border: 1px solid #eaeaea;
      border-radius: 8px;
      color: #2c3e50;
    }
    .password-toggle {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #1e2a5e;
    }
    .login-button {
      background-color: #1e2a5e;
      border-radius: 8px;
      padding: 15px;
      color: white;
      font-weight: bold;
      width: 100%;
      border: none;
      margin-top: 20px;
    }
    .login-button:disabled {
      background-color: #A0CFFF;
    }
    .google-login-button {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #1e2a5e;
      border-radius: 8px;
      padding: 12px;
      color: #1e2a5e;
      font-weight: bold;
      width: 100%;
      text-decoration: none;
    }
    .google-login-button i {
      margin-right: 10px;
      font-size: 24px;
    }
    .forgot-password {
      color: #1e2a5e;
      text-align: center;
      display: block;
      margin-bottom: 20px;
    }
    .divider {
      height: 1px;
      background-color: #eaeaea;
      margin-bottom: 15px;
    }
    .privacy-container {
      display: flex;
      align-items: center;
    }
    .checkbox-container {
      margin-right: 10px;
    }
    .custom-checkbox {
      width: 20px;
      height: 20px;
      border: 1px solid #1e2a5e;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }
    .custom-checkbox.checked {
      background-color: #1e2a5e;
      color: white;
    }
    .privacy-text {
      font-size: 0.875rem;
      color: #2c3e50;
    }
    .privacy-link {
      color: #1e2a5e;
      font-weight: bold;
      text-decoration: underline;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="blue-section">
    <h1 class="welcome-title">TABIK PUN</h1>
    <p class="welcome-text">Selamat Datang Di Aplikasi Siap Tuba</p>
    <img src="{{ asset('assets/img/src_assets_images_bupati_wakil.webp') }}" alt="Bupati Wakil" class="logo-image">
  </div>

  <div class="form-container">
    <div class="container">
      @if (session('error'))
          <div class="alert alert-danger">Email atau password salah!</div>
      @endif
      <form action="/user/login" method="POST">
      @csrf
      <div class="input-container">
        <i class="bi bi-envelope input-icon"></i>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
      </div>
      <div class="input-container">
        <i class="bi bi-lock input-icon"></i>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        <i class="bi bi-eye password-toggle" id="password-toggle"></i>
      </div>
      
      <div class="privacy-container mb-3">
        <div class="checkbox-container">
          <div class="custom-checkbox checked" id="privacy-checkbox">
            <i class="bi bi-check"></i>
          </div>
        </div>
        <div class="privacy-text">
          Saya menyetujui <span class="privacy-link" id="privacy-link">Privacy & Policy</span>
        </div>
      </div>
      
      <button class="login-button" type="submit" id="login-button">Login</button>
      </form>
      <div class="text-center mt-3 mb-3">
        <a href="#" class="forgot-password">Lupa password?</a>
      </div>
      
      <div class="divider"></div>
      
      <a href="#" class="google-login-button mt-3" id="google-login-button">
        <i class="bi bi-google"></i> Login dengan Google
      </a>
    </div>
  </div>

  <!-- Bootstrap 5 JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const emailInput = document.getElementById('email');
      const passwordInput = document.getElementById('password');
      const passwordToggle = document.getElementById('password-toggle');
      const loginButton = document.getElementById('login-button');
      const googleLoginButton = document.getElementById('google-login-button');
      const privacyCheckbox = document.getElementById('privacy-checkbox');
      const privacyLink = document.getElementById('privacy-link');
      let showPassword = false;
      let agreeToPrivacy = true;

      // Toggle password visibility
      passwordToggle.addEventListener('click', () => {
        showPassword = !showPassword;
        passwordInput.type = showPassword ? 'text' : 'password';
        passwordToggle.classList.toggle('bi-eye');
        passwordToggle.classList.toggle('bi-eye-slash');
      });

      // Handle Google login
      googleLoginButton.addEventListener('click', (e) => {
        e.preventDefault();
        if (!agreeToPrivacy) {
          alert('Anda harus menyetujui Privacy & Policy untuk melanjutkan.');
          return;
        }

        // Simulate Google login (replace with actual Google Sign-In)
        alert('Google Sign-In sedang diperbaiki...');
      });

      // Toggle privacy checkbox
      privacyCheckbox.addEventListener('click', () => {
        agreeToPrivacy = !agreeToPrivacy;
        privacyCheckbox.classList.toggle('checked');
        if (agreeToPrivacy) {
          privacyCheckbox.innerHTML = '<i class="bi bi-check"></i>';
        } else {
          privacyCheckbox.innerHTML = '';
        }
      });

      // Handle privacy policy link
      privacyLink.addEventListener('click', (e) => {
        e.preventDefault();
        // Navigate to privacy policy page or open modal (implement as needed)
        alert('Sedang ada perbaikan pada Privacy & Policy.');
      });
      
      // Make shortcut cards clickable
      document.querySelectorAll('.shortcut-card').forEach(card => {
        card.addEventListener('click', function() {
          const menuName = this.querySelector('.shortcut-text').textContent;
          alert(`Menu ${menuName} diklik. Implementasikan fungsi untuk ${menuName}.`);
        });
      });
    });
  </script>
</body>
</html>