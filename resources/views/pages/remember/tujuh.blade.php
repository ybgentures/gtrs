<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Chapter 1 - Gentures 23</title>
  <link rel="shortcut icon" href="{{ asset('img/llog_gen3.webp"/>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

@include('layouts.nav')

  <main class="agenda-main-wrapper">
    
    <section class="chapter-section">
      
      <div class="chapter-hero-bg">
        <div class="chapter-overlay"></div>
        <h1 class="chapter-title">Chapter 1 : The Journey Begins</h1>
      </div>

      <div class="chapter-container">
        
        <div class="kegiatan-box rata-kanan">
          <h2 class="kegiatan-judul">Pentas Seni Gentures</h2>
          <p class="kegiatan-deskripsi">
            Langkah pertama kebersamaan kita dimulai dari sini. Di panggung inilah mental, rasa percaya diri, dan ikatan kekeluargaan Angkatan 23 pertama kali ditempa bersama di bawah atap Ma'had Al-Zaytun. Sebuah awal perjalanan panjang yang tak akan pernah terlupakan.
          </p>
        </div>
<div class="pinterest-grid">
          
          <div class="frame-gallery rasio-9-16">
            <img src="{{ asset('img/rla.png') }}" alt="Kenangan Kelas 7" loading="lazy">
          </div>

          <div class="frame-gallery rasio-16-9">
            <img src="{{ asset('img/pel_hakim.webp') }}" alt="Kenangan Kelas 7" loading="lazy">
          </div>
          <div class="frame-gallery rasio-16-9">
            <img src="{{ asset('img/b2.png') }}" alt="Kenangan Kelas 7" loading="lazy">
          </div>

          <div class="frame-gallery rasio-9-16">
            <img src="{{ asset('img/b1.png') }}" alt="Kenangan Kelas 7" loading="lazy">
          </div>

          <div class="frame-gallery rasio-9-16">
            <img src="{{ asset('img/b3.png') }}" alt="Kenangan Kelas 7" loading="lazy">
          </div>

          <div class="frame-gallery rasio-16-9">
            <img src="{{ asset('img/news_1.JPG') }}" alt="Kenangan Kelas 7" loading="lazy">
          </div> 

          <div class="frame-gallery rasio-16-9">
            <img src="{{ asset('img/log_gen3.webp') }}" alt="Kenangan Kelas 7" loading="lazy">
          </div>

          <div class="frame-gallery rasio-9-16">
            <img src="{{ asset('img/log_gen3.webp') }}" alt="Kenangan Kelas 7" loading="lazy">
          </div>

          </div>

      </div>
    </section>

    </main>

@include('layouts.footer')

</body>
</html>