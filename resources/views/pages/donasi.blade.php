<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Gentures23" />
  <meta name="keywords"
    content="Gentures, Gentures23, 23gentures, angkatan23,angkatan 23 Gentures, Gentures Al-Zaytun" />
  <title>Gentures</title>
  <link rel="shortcut icon" href="img/log_gen3.webp"/>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
@include('layouts.nav')
<main class="donasi-page-wrapper">
  <div class="donasi-main-container">
    
    <div class="donasi-konten-kiri">
      <h2 class="donasi-utama-judul">Ayo Dukung GENTURES</h2>
      <p class="donasi-utama-deskripsi">
        Dana yang terkumpul akan digunakan sepenuhnya untuk menunjang segala kebutuhan serta pengadaan barang inventaris Angkatan Gentures 23, di antaranya:
      </p>
      
      <ul class="inventaris-list">
        <li>
          <div class="inventaris-nomer">1</div>
          <div class="inventaris-teks">
            <i class="fa-solid fa-volume-high"></i> Sound System Angkatan
          </div>
        </li>
        <li>
          <div class="inventaris-nomer">2</div>
          <div class="inventaris-teks">
            <i class="fa-solid fa-print"></i> Printer Kebutuhan Administrasi
          </div>
        </li>
        <li>
          <div class="inventaris-nomer">3</div>
          <div class="inventaris-teks">
            <i class="fa-solid fa-bars-staggered"></i> Tirai Panggung untuk Acara Besar 
          </div>
        </li>
        <li>
          <div class="inventaris-nomer">4</div>
          <div class="inventaris-teks">
            <i class="fa-solid fa-book"></i> ATK kebutuhan administrasi dan acara
          </div>
        </li>
        <li>
          <div class="inventaris-nomer">5</div>
          <div class="inventaris-teks">
            <i class="fa-solid fa-wifi"></i> Perangkat Pendukung Dokumentasi
          </div>
        </li>
      </ul>
    </div>

    <div class="donasi-konten-kanan">
      <div class="grid-donasi">
        <div class="kartu-donasi">
          <i class="fa-solid fa-qrcode icon-donasi"></i>
          <h3>Scan QRIS</h3>
          <div class="bingkai-qris">
            <img id="qrisImage" src="{{ asset('img/qrisdonate.jpeg') }}" alt="QRIS Donasi">
          </div>
          <p class="instruksi">Simpan gambar lalu scan melalui aplikasi Bank atau E-Wallet kamu.</p>
          <button class="but-aksi but-download" onclick="downloadQRIS()">
            <i class="fa-solid fa-download"></i> Simpan Kode QR
          </button>
        </div>
        <div class="kartu-donasi">
          <i class="fa-solid fa-university icon-donasi"></i>
          <h3>Transfer Bank</h3>
          <div class="bingkai-bank">
            <img src="{{ asset('img/bcalogo.png') }}" alt="BCA" class="logo-bank">
            <p class="no-rek" id="rekBCA">5857051292</p>
            <p class="nama-rek">a.n IHSAN FIRMANSYAH</p>
          </div>
          <p class="instruksi">Pastikan nomor rekening dan nama penerima sudah sesuai sebelum transfer.</p>
          <button class="but-aksi but-copy" onclick="copyRekening()">
            <i class="fa-solid fa-copy"></i> Salin No. Rekening
          </button>
        </div>
      </div>
      <div class="konfirmasi-wa-box">
    <p>Sudah melakukan donasi? Yuk konfirmasi bukti transfermu di sini!</p>
    <a href="https://wa.me/62895400978229?text=Assalamu'alaikum%20Bendahara,%20saya%20ingin%20konfirmasi%20donasi%20angkatan."
       class="but-wa" target="_blank">
      <i class="fa-brands fa-whatsapp"></i> Kirim Bukti Transfer
    </a>
  </div>
    </div>
    </div>

  <section class="supportmin">
    <div class="supportmin-info">
      <h1>TRAKTIR KOPI BUAT DEVELOPER</h1>
      <p>Terimakasih sudah bantu Admin dalam mengembangkan website ini, semoga kebaikanmu dibalas dengan kebaikan yang berlipat ganda. Aamiin.</p>
      <a href="https://saweria.co/farhanalhuda" class="but-saweria" target="_blank">
        <i class="fa-solid fa-coffee"></i> via Saweria
      </a>
    </div>

    <div class="kartu-donasi kartu-donasi-admin">
      <i class="fa-solid fa-qrcode icon-donasi"></i>
      <h3>Traktir Kopi</h3>
      <div class="bingkai-qris">
        <img id="qrisAdmin" src="{{ asset('img/qrisdonate2.jpeg') }}" alt="QRIS Admin">
      </div>
      <p class="instruksi">Simpan gambar lalu scan melalui aplikasi Bank atau E-Wallet kamu.</p>
      
      <button class="but-aksi but-download" onclick="downloadQRISAdmin()">
        <i class="fa-solid fa-download"></i> Simpan QRIS Admin
      </button>
    </div>
  </section>
</main>

</body>