<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Gentures - Ma'had Al-Zaytun</title>
  <link rel="shortcut icon" href="{{ asset('img/log_gen3.webp') }}"/>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="zaytun-modern-bg">
  @include('layouts.nav')
  
  <main class="kontainer-utama">
    
    <div class="header-zaytun-wrapper">
      <div class="judul-grup">
        <img src="{{ asset('img/zaytunlogo.png') }}" alt="Logo Zaytun" class="logo-zaytun" loading="lazy">
        <h1 class="judul-zaytun">Ma'had Al-Zaytun</h1>
      </div>
      <p class="subtitle-zaytun">
        Pusat Pendidikan Pengembangan Budaya Toleransi dan Perdamaian Menuju Masyarakat Sehat Cerdas dan Manusiawi.
      </p>
    </div>

    <div class="kotak-interaktif-container">
      
      <div class="kotak-item efek-kaca" onclick="toggleKotak(this)">
        <div class="kotak-header">
          <h3>Misi</h3>
          <i class="fa-solid fa-chevron-down ikon-toggle"></i>
        </div>
        <div class="kotak-konten">
          <div class="isi-teks">
            <p>Mempersiapkan peserta didik untuk berakidah kokoh kuat terhadap Allah dan Syariatnya menyatu didalam tauhid berakhlakul karimah berilmu pengetahuan luas berketerampilan tinggi yang menyatu dalam "Basthotan fi Al-Ilmi wal Jismi" sehingga sanggup siap dan mampu untuk hidup secara dinamis di lingkungan negara bangsanya dan masyarakat antar bangsa dengan penuh kesejahteraan serta kebahagian duniawi maupun ukhrowi.</p>
          </div>
        </div>
      </div>

      <div class="kotak-item efek-kaca" onclick="toggleKotak(this)">
        <div class="kotak-header">
          <h3>Takhsis</h3>
          <i class="fa-solid fa-chevron-down ikon-toggle"></i>
        </div>
        <div class="kotak-konten">
          <div class="isi-teks">
            <p>Memperbaiki kualitas pendidikan Indonesia dengan melaksanakan pendidikan yang memiliki ciri khusus (takhsis):</p>
            <ol>
              <li>Penguasaan Al-Qur'an secara mendalam</li>
              <li>Terampil berkomunikasi menggunakan bahasa-bahasa antar bangsa yang dominan</li>
              <li>Berpendekatan ilmu pengetahuan dan teknologi</li>
              <li>Berketerampilan tinggi</li>
              <li>Berbadan sehat</li>
              <li>Berjiwa Mandiri</li>
              <li>Penuh perhatian terhadap aspek dinamika kelompok dan bangsa</li>
              <li>Berdisiplin tinggi</li>
              <li>Berkesenian yang memadai</li>
              <li>Penerapan ilmu yang faktual</li>
            </ol>
          </div>
        </div>
      </div>

    </div>
  <section class="masjid-container">
      <div class="masjid-image-wrapper">
        <img src="{{ asset('img/masjid.png') }}" alt="Masjid Rahmatan Lil Alamin" class="masjid-img">
      </div>
      
      <div class="masjid-desc-grid">
        <div class="efek-kaca deskripsi-item">
          <h3>Masjid Rahmatan Lil Alamin</h3>
          <p>Merupakan pusat kegiatan ibadah dan spiritual di Ma'had Al-Zaytun. Masjid berlantai 6 yang megah ini didesain dengan arsitektur monumental, menjadi simbol kebesaran peradaban dan pusat pembinaan toleransi serta perdamaian bagi seluruh sivitas akademika.</p>
        </div>
        <div class="efek-kaca deskripsi-item">
          <h3>Menara Pemuda Perdamaian</h3>
          <p>Berdiri kokoh di sisi masjid, menara ini menjadi ikon semangat kaum muda dalam menyuarakan perdamaian dunia. Dari puncaknya, kita dapat melihat tata ruang kampus yang rapi, melambangkan visi jauh ke depan menuju masyarakat yang sehat, cerdas, dan manusiawi.</p>
        </div>
      </div>
    </section>

    <section class="fasilitas-container">
      <h2 class="judul-section">Asrama Pelajar</h2>
      <div class="fasilitas-grid">
        
        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Persahabatan" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Persahabatan</h3>
            <p>Diperuntukan untuk Pelajar Kelas 1 sampai 6 Banin (Putra) dan Banat (Putri). Tempat langkah awal kemandirian ditempa.</p>
          </div>
        </div>

        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Al-Madani" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Al-Madani</h3>
            <p>Diperuntukan untuk Pelajar Tsanawiyah (Kelas 7, 8, dan 9). Al-Madani untuk Banin, dan Al-Musthofa untuk Banat.</p>
          </div>
        </div>

        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Al-Fajr" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Al-Fajr</h3>
            <p>Diperuntukan untuk Pelajar Aliyah (Kelas 10, 11, dan 12). Al-Fajr untuk Banin, dan Al-Nur untuk Banat. Fase menuju kedewasaan.</p>
          </div>
        </div>

        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Al-Madani" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Al-Musthofa</h3>
            <p>Diperuntukan untuk Pelajar Tsanawiyah (Kelas 7, 8, dan 9). Al-Madani untuk Banin, dan Al-Musthofa untuk Banat.</p>
          </div>
        </div>

        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Al-Fajr" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Al-Nur</h3>
            <p>Diperuntukan untuk Pelajar Aliyah (Kelas 10, 11, dan 12). Al-Fajr untuk Banin, dan Al-Nur untuk Banat. Fase menuju kedewasaan.</p>
          </div>
        </div>


      </div>
    </section>

    <section class="fasilitas-container">
      <h2 class="judul-section">Gedung Pembelajaran</h2>
      <div class="fasilitas-grid grid-3-kolom">
        
        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Utsman bin Affan" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Utsman bin Affan</h3>
            <p>Digunakan Angkatan 23 untuk mengikuti kegiatan pembelajaran. Digunakan saat berada di jenjang Aliyah bagi santri yang mengambil jurusan non-ekskul pertanian maupun perkapalan.</p>
          </div>
        </div>

        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Dato' Tans Sri" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Dato' Tansri</h3>
            <p>Gedung megah yang digunakan Angkatan 23 saat berada di jenjang Aliyah khusus bagi para santri yang mengambil ekskul spesifik seperti pertanian maupun perkapalan.</p>
          </div>
        </div>

          <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Dato' Tans Sri" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Ali ibnu Abi Thalib</h3>
            <p>Gedung megah yang digunakan Angkatan 23 saat berada di jenjang Aliyah khusus bagi para santri yang mengambil ekskul spesifik seperti pertanian maupun perkapalan.</p>
          </div>
        </div>

        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Dato' Tans Sri" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Umar ibnu Khattab</h3>
            <p>Gedung megah yang digunakan Angkatan 23 saat berada di jenjang Aliyah khusus bagi para santri yang mengambil ekskul spesifik seperti pertanian maupun perkapalan.</p>
          </div>
        </div>

        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Dato' Tans Sri" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>Abu Bakar As-Shidiq</h3>
            <p>Gedung megah yang digunakan Angkatan 23 saat berada di jenjang Aliyah khusus bagi para santri yang mengambil ekskul spesifik seperti pertanian maupun perkapalan.</p>
          </div>
        </div>

        <div class="kartu-kaca">
          <div class="kartu-img-wrapper">
            <img src="{{ asset('img/rla.png') }}" alt="Dato' Tans Sri" loading="lazy">
          </div>
          <div class="kartu-teks">
            <h3>H. Muhammad Soeharto</h3>
            <p>Gedung megah yang digunakan Angkatan 23 saat berada di jenjang Aliyah khusus bagi para santri yang mengambil ekskul spesifik seperti pertanian maupun perkapalan.</p>
          </div>
        </div>

      </div>
    </section>
  </main>
  
  @include('layouts.footer')
</body>
</html>