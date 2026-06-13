<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Member - Gentures 23</title>
  <link rel="shortcut icon" href="{{ asset('img/log_gen3.webp') }}" />
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100vh;
      width: 100vw;
      font-family: 'Montserrat', sans-serif;
      overflow: hidden;
      background-color: #001a38;
    }

    /* Kontainer Utama membagi layar */
    .login-split-wrapper {
      display: flex;
      width: 100%;
      height: 100vh;
    }

    /* BAGIAN KIRI: Form Login (Komposisi 1 Bagian = 25% - 30% Width) */
    .login-sidebar-panel {
      flex: 1;
      min-width: 350px;
      max-width: 400px;
      background: linear-gradient(135deg, #002e5f, #001a38);
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 40px 35px;
      box-sizing: border-box;
      color: #ffffff;
      box-shadow: 10px 0 30px rgba(0,0,0,0.3);
      z-index: 10;
    }

    /* BAGIAN KANAN: Foto Angkatan Bersama (Komposisi 3 Bagian = Sisa Screen) */
    .login-photo-panel {
      flex: 3;
      position: relative;
      background-image: url('img/allgen.png'); /* Silakan ganti ke file foto angkatan bersama kamu */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    /* Efek Gradasi di Atas Foto Kanan agar Serasi dengan Panel Kiri */
    .login-photo-panel::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(to right, rgba(0, 26, 56, 0.8), rgba(0, 78, 132, 0.2));
    }

    /* --- TYPOGRAPHY TEXT --- */
    .welcome-text {
      font-size: 0.95rem;
      font-weight: 500;
      color: #add3e6;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      margin-bottom: 5px;
    }

    .brand-title {
      font-size: 3rem; /* Font jauh lebih besar sesuai permintaan */
      font-weight: 900;
      color: #76cdd2;
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-bottom: 35px;
      text-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    /* --- INPUT GROUP DENGAN HOVER & FOCUS YANG KEREN --- */
    .custom-input-group {
      position: relative;
      margin-bottom: 22px;
    }

    .custom-input-group i {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #a0c3e2;
      font-size: 1.1rem;
      transition: all 0.3s ease;
    }

    .custom-input-group input {
      width: 100%;
      padding: 16px 16px 16px 52px;
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 16px;
      outline: none;
      color: #ffffff;
      font-size: 1rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-sizing: border-box;
    }

    .custom-input-group input::placeholder {
      color: #8daac4;
    }

    /* Efek Hover Cantik saat Kursor Mendekat */
    .custom-input-group input:hover {
      border-color: rgba(58, 190, 252, 0.5);
      background: rgba(255, 255, 255, 0.1);
    }

    /* Efek Focus Bersinar Luar Biasa saat Mengetik */
    .custom-input-group input:focus {
      border-color: #3abefc;
      background: rgba(0, 0, 0, 0.2);
      box-shadow: 0 0 18px rgba(58, 190, 252, 0.4), inset 0 0 5px rgba(255,255,255,0.1);
    }

    /* Ikon ikut menyala saat input aktif */
    .custom-input-group input:focus + i,
    .custom-input-group input:hover + i {
      color: #3abefc;
      transform: translateY(-50%) scale(1.1);
    }

    /* Tombol Masuk */
    .btn-submit-premium {
      width: 100%;
      padding: 16px;
      border: none;
      border-radius: 16px;
      background: linear-gradient(135deg, #ffcc00, #ff9900);
      color: #002e5f;
      font-size: 1.1rem;
      font-weight: 800;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 20px rgba(255, 153, 0, 0.25);
      margin-top: 15px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .btn-submit-premium:hover {
      transform: scale(1.03);
      box-shadow: 0 12px 28px rgba(255, 153, 0, 0.45);
      filter: brightness(1.05);
    }

    /* Kotak Pesan Error */
    .alert-error-box {
      background: rgba(255, 77, 77, 0.15);
      border: 1px solid #ff4d4d;
      color: #ff4d4d;
      padding: 12px 15px;
      border-radius: 12px;
      font-size: 0.88rem;
      margin-bottom: 25px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .link-back {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-top: 30px;
      color: #8daac4;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 600;
      transition: 0.3s;
    }

    .link-back:hover {
      color: #3abefc;
    }

    /* =========================================
       RESPONSIVITAS OTOMATIS LAYAR HP
       ========================================= */
    @media (max-width: 768px) {
      .login-split-wrapper {
        flex-direction: column; /* Mengubah susunan menjadi atas-bawah di HP */
      }

      /* Di HP, Panel Foto dijadikan Background Penuh di Belakang */
      .login-photo-panel {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100vh;
        flex: none;
      }

      .login-photo-panel::before {
        background: rgba(0, 26, 56, 0.75); /* Gelapkan background foto di HP */
      }

      /* Panel Form melayang transparan (Glassmorphism) di atas foto */
      .login-sidebar-panel {
        position: relative;
        flex: none;
        width: calc(100% - 40px);
        max-width: 380px;
        height: auto;
        margin: auto;
        background: rgba(0, 46, 95, 0.5);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        padding: 35px 25px;
      }

      .brand-title {
        font-size: 2.3rem;
        margin-bottom: 25px;
      }
    }
  </style>  

  <div class="login-split-wrapper">
    
    <div class="login-sidebar-panel">
      
      <div>
        <p class="welcome-text">Welcome and Enjoy Our Website</p>
        <h1 class="brand-title">Gentures</h1>
      </div>

      @if (session('error'))
          <div class="alert-error-box">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
          </div>
      @endif

      <form method="POST" action="/login">
        <div class="custom-input-group">
          <input type="text" name="no_id" placeholder="Masukkan No ID" required autocomplete="off">
          <i class="fa-solid fa-id-badge"></i>
        </div>
        
        <div class="custom-input-group">
          <input type="password" name="password" placeholder="Masukkan Password" required>
          <i class="fa-solid fa-key"></i>
        </div>
        
        <button type="submit" name="btn_login" class="btn-submit-premium">
          Login <i class="fa-solid fa-arrow-right-to-bracket" style="margin-left: 6px;"></i>
        </button>

      </form>

      <a href="index.php" class="link-back">
        <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Beranda
      </a>

    </div>

    <div class="login-photo-panel"></div>

  </div>

</body>
</html>