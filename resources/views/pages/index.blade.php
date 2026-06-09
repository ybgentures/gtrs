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
  @vite('resources/css/app.css')
  @vite('resources/js/timerkritik.js')
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  @include('layouts.nav')
  <main>
  <section class="carousel">
    <div class="imghome">
      <img src="{{ asset('img/b1.png') }}" alt="jae" loading="eager" />
    </div>
    <div class="imghome">
      <img src="{{ asset('img/b2.png') }}" alt="jae" loading="eager" />
    </div>
    <div class="imghome">
      <img src="{{ asset('img/b3.png') }}" alt="jae" loading="eager" />
    </div>
    <div class="imghome">
      <img src="{{ asset('img/rla.png') }}" alt="jae" loading="eager" />
    </div>
    <div class="imghome">
      <img src="{{ asset('img/rla.png') }}" alt="jae" loading="eager" />
    </div>
  </section>
  <div class="tombol">
    <h1>THIS IS OUR TOGETHERNESS</h1>
    <p>Pilih Tingkatan Kelas Untuk Melihat Kenangannya</p>
    <div class="grup-tombol">
      <a href="/tujuh" class="tombl">7th</a>
      <a href="/delapan" class="tombl">8th</a>
      <a href="/sembilan" class="tombl">9th</a>
      <a href="/sepuluh" class="tombl">10th</a>
      <a href="/sebelas" class="tombl">11th</a>
      <a href="/duabelas" class="tombl">12th</a>
    </div>
  </div>
<section class="org-beranda-section">
  <div class="org-beranda-container">
    
    <div class="photo-deck-left">
      <div class="frame-pemimpin frame-mpk">
        <img src="{{ asset('img/ketuampk.png') }}" alt="Ketua MPK Gentures">
        <div class="frame-label">KETUA MPK</div>
      </div>
      
      <div class="frame-pemimpin frame-opmaz">
        <img src="{{ asset('img/pres.png') }}" alt="Presiden OPMAZ Gentures">
        <div class="frame-label">PRESIDEN OPMAZ</div>
      </div>
    </div>

    <div class="control-panel-right">
      <span class="sub-title-org">SISTEM ORGANISASI</span>
      <h2 class="title-org">Gentures Leadership</h2>
      <p class="desc-org">
        Sinergi hebat yang menggerakkan kreativitas, kedisiplinan, dan persatuan di dalam Angkatan 23 Gentures. Jelajahi struktural lengkap kepengurusan kami.
      </p>
      
      <div class="glow-buttons-wrapper">
        <a href="/mpk" class="neon-glow-btn btn-warna-mpk">
          <div class="btn-content">
            <span class="main-txt">STRUKTURAL MPK</span>
            <span class="sub-txt">Majelis Permusyawaratan Kelas</span>
          </div>
          <div class="logo-icon">
            <img src="{{ asset('img/logo_gen5.png') }}" class="logoicon" alt="Logo MPK" class="icon-mpk" />
          </div>
        </a>
        
        <a href="/opmaz" class="neon-glow-btn btn-warna-opmaz">
          <div class="btn-content">
            <span class="main-txt">STRUKTURAL OPMAZ</span>
            <span class="sub-txt">Organisasi Pelajar Mahad Al-Zaytun</span>
          </div>
          <div class="logo-icon">
            <img src="{{ asset('img/logoopm.png') }}" class="logoicon" alt="Logo OPMAZ" class="icon-opmaz" />
          </div>
        </a>
      </div>
    </div>

  </div>
</section>

<section class="pelajar-section">
  <div class="glass-box-pelajar">
    
    <!-- Bagian Kiri: Teks dan Tombol (Logika Login Tetap Berjalan) -->
    <div class="teks-pelajar">
      <h2>Member of 23th Generation Al-Zaytun</h2>
      <p class="jumlah-angkatan">
        Total Angkatan: <strong>488 Pelajar</strong> <br>
        Banin: 260 | Banat: 228
      </p>
      
      @if (session('role') == 'member')
        <a href="/pelajar" class="btn-selengkapnya">Tampilkan lebih banyak <i class="fa-solid fa-arrow-right"></i></a>
        @else
        <a href="/login" class="btn-selengkapnya">Login Untuk Melihat Lebih <i class="fa-solid fa-lock"></i></a>
        @endif
    </div>

    <!-- Bagian Kanan: Galeri Foto (Sekarang Terbuka untuk Umum) -->
    <div class="galeri-scroll">
      
      <div class="kartu-teman">
        <img src="{{ asset('img/pel_ibnu.webp') }}" alt="Ibnu Satria" loading="eager">
        <h4>Ibnu Satria</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_raissa.webp') }}" alt="Raissa Aulia" loading="eager">
        <h4>Raissa Aulia Salsabila</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_ihsansyatiri.webp') }}" alt="Ihsan Syatiri" loading="eager">
        <h4>Ihsan Syatiri Ahmad</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_gita.webp') }}" alt="Anggita Syahrani" loading="eager">
        <h4>Anggita Syahrani</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_rafa.webp') }}" alt="Rafa Adliansyah" loading="eager">
        <h4>Rafa Adliansyah Arizky</h4>
      </div>
      
      <div class="kartu-teman">
        <img src="{{ asset('img/pel_alya.webp') }}" alt="Alya Yasmin" loading="eager">
        <h4>Alya Yasmin</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_faiq.webp') }}" alt="Faiq Hauzan" loading="eager">
        <h4>Faiq Hauzan</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_dewi.webp') }}" alt="Dewi Sri Elmira" loading="eager">
        <h4>Dewi Sri Elmira</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_iqbal.webp') }}" alt="Iqbal Aranda" loading="eager">
        <h4>Iqbal Aranda</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_cinta.webp') }}" alt="Cinta Kenia Al Mukti" loading="eager">
        <h4>Cinta Kenia Al Mukti</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_addy.webp') }}" alt="Addy Birroka" loading="eager">
        <h4>Addy Birroka</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_chiesawa.webp') }}" alt="Chiesawa Nirwana" loading="eager">
        <h4>Chiesawa Nirwana</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_ahnaf.webp') }}" alt="Ahnaf Ramadhan" loading="eager">
        <h4>Ahnaf Ramadhan</h4>
      </div>

       <div class="kartu-teman">
        <img src="{{ asset('img/pel_rara.webp') }}" alt="Putri Mutiara" loading="eager">
        <h4>Putri Mutiara</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_dimas.webp') }}" alt="Dimas Maharanu Alfath" loading="eager">
        <h4>Dimas Maharanu Alfath</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_mj.webp') }}" alt="Almirah Miftahul Jannah" loading="eager">
        <h4>Almirah Miftahul Jannah</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_fatih.webp') }}" alt="Fatih Izzudin" loading="eager">
        <h4>Fatih Izzudin</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_raisaajeng.webp') }}" alt="Raisa Ajeng" loading="eager">
        <h4>Raisa Ajeng Filiana</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_abiidin.webp') }}" alt="Abi Diin" loading="eager">
        <h4>Muhammad F. Abi Diin</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_adiban.webp') }}" alt="Adiban Rizqi" loading="eager">
        <h4>Adiban Rizqi</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_musa.webp') }}" alt="Musa Nur Jihady" loading="lazy">
        <h4>Musa Nur Jihady</h4>
      </div>

      <div class="kartu-teman">
        <img src="{{ asset('img/pel_arifin.webp') }}" alt="Arifin Putra Pratama" loading="lazy">
        <h4>Arifin Putra Pratama</h4>
      </div>

    </div> <!-- Akhir dari galeri-scroll -->
  </div> <!-- Akhir dari glass-box-pelajar -->
</section>
<section class="news-section">
  <div class="news-wrapper">
    
    <h2 class="news-header">News of 23th</h2>

    <div class="news-container">
      
      <article class="news-card">
        <a href="/one" class="news-link">
        <div class="news-img-box">
          <img src="{{ asset('img/news_1.JPG') }}" alt="Berita 1">
          <span class="news-date">15 Mei 2024</span>
        </div>
        <div class="news-content">
          <h3>Persiapan Ujian Akhir Angkatan 23</h3>
          <p>Seluruh santri angkatan 23 mulai fokus melakukan muroja'ah bersama...</p>
        </div>
        </a>
      </article>

      <article class="news-card">
        <a href="/two" class="news-link">
        <div class="news-img-box">
          <img src="{{ asset('img/zaytun.webp') }}" alt="Berita 2">
          <span class="news-date">10 Mei 2024</span>
        </div>
        <div class="news-content">
          <h3>Kemenangan Lomba Olahraga Antar Angkatan</h3>
          <p>Gentures berhasil membawa pulang piala bergilir dalam turnamen bola basket...</p>
        </div>
        </a>
      </article>
      

      <article class="news-card">
        <a href="/three" class="news-link">
        <div class="news-img-box">
          <img src="{{ asset('img/rla.png') }}" alt="Berita 3">
          <span class="news-date">05 Mei 2024</span>
        </div>
        <div class="news-content">
          <h3>Proyek Sosial Gentures di Lingkungan Sekitar</h3>
          <p>Bentuk kepedulian angkatan 23 terhadap masyarakat di sekitar Al-Zaytun...
        </div>
        </a>
      </article>

    </div>

    <div class="news-footer">
      <a href="news.php" class="btn-cari-tahu">
        Cari tahu lebih banyak<i class="fa-solid fa-chevron-right"></i>
      </a>
    </div>
  </div>
</section>
<section class="video-doc-section">
  <div class="video-wrapper">
    
    <h2 class="video-header">Video Documenter</h2>

    <div class="video-grid">
      
      <a href="https://youtube.com/link_video_1" class="video-item" target="_blank">
        <div class="video-thumb">
          <img src="{{ asset('img/mpk12.webp') }}" alt="Dokumenter 1st">
          <div class="shine-effect"></div> <div class="play-overlay">
            <i class="fa-solid fa-play"></i>
          </div>
        </div>
        <div class="video-title">
          <span>1st</span> Documenter
        </div>
      </a>

      <a href="https://youtube.com/link_video_2" class="video-item" target="_blank">
        <div class="video-thumb">
          <img src="{{ asset('img/opm.webp') }}" alt="Dokumenter 2nd">
          <div class="shine-effect"></div>
          <div class="play-overlay">
            <i class="fa-solid fa-play"></i>
          </div>
        </div>
        <div class="video-title">
          <span>2nd</span> Documenter
        </div>
      </a>

      <a href="https://youtube.com/link_video_3" class="video-item" target="_blank">
        <div class="video-thumb">
          <img src="{{ asset('img/allgen.png') }}" alt="Dokumenter 3rd">
          <div class="shine-effect"></div>
          <div class="play-overlay">
            <i class="fa-solid fa-play"></i>
          </div>
        </div>
        <div class="video-title">
          <span>3rd</span> Documenter
        </div>
      </a>

      <a href="https://youtube.com/link_video_4" class="video-item" target="_blank">
        <div class="video-thumb">
          <img src="{{ asset('img/rla.png') }}" alt="Dokumenter 4th">
          <div class="shine-effect"></div>
          <div class="play-overlay">
            <i class="fa-solid fa-play"></i>
          </div>
        </div>
        <div class="video-title">
          <span>4th</span> Documenter
        </div>
      </a>

      <a href="https://youtube.com/link_video_5" class="video-item" target="_blank">
        <div class="video-thumb">
          <img src="{{ asset('img/wapres.jpeg') }}" alt="Dokumenter 5th">
          <div class="shine-effect"></div>
          <div class="play-overlay">
            <i class="fa-solid fa-play"></i>
          </div>
        </div>
        <div class="video-title">
          <span>5th</span> Documenter
        </div>
      </a>

      <a href="https://youtube.com/link_video_6" class="video-item" target="_blank">
        <div class="video-thumb">
          <img src="{{ asset('img/b3.png') }}" alt="Dokumenter 6th">
          <div class="shine-effect"></div>
          <div class="play-overlay">
            <i class="fa-solid fa-play"></i>
          </div>
        </div>
        <div class="video-title">
          <span>6th</span> Documenter
        </div>
      </a>

    </div>
  </div>
</section>
 @if (session('role') == 'member') 
    <div class="kontainerform">
      <div class="kotakform efect">
        <div>
          <h2>Hai Gentures!!</h2>
          <p>Isi Identitas dirimu di sini ya, ini buat Buku Alumni Angkatan kita</p>
        </div>
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSdVZ_k-pNWkgxd9VZKG_NzI-JwLH9d-Gh_RtHgR2ZCMS___Dg/viewform?usp=publish-editor"
           target="_blank" class="tomblform">Klik</a>
      </div>
    </div>
  @endif
<section class="saran-section">
  <div class="saran-container">
    
    <!-- Bagian Teks Penjelasan -->
    <div class="saran-teks">
      <h2><i class="fa-solid fa-comments"></i> Saran & Kritik</h2>
      <p>Punya ide cemerlang, keluhan, atau masukan untuk Angkatan 23 Gentures? Jangan ragu untuk menyampaikannya di sini. Siapapun boleh memberi saran dan kritik, adik kelas, teman seangkatan, guru atau alumni, semuanya boleh. Suaramu sangat berarti untuk Gentures!</p>
      <div class="saran-ilustrasi">
        <i class="fa-regular fa-lightbulb"></i>
      </div>
    </div>
  <div class="saran-form-box">
  <form action="https://formspree.io/f/mbdbyvow" method="POST" class="form-saran" id="formSaran">
    
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="Nama" placeholder="Contoh: Noval" required>
    </div>

    <div class="form-group">
      <label for="asal">Siapa kamu?</label>
      <input type="text" id="asal" name="Asal" placeholder="Contoh: Pelajar Angkatan 23" required>
    </div>

    <div class="form-group">
      <label for="pesan">Pesan</label>
      <textarea id="pesan" name="Pesan" rows="5" placeholder="Tuliskan saran, kritik, atau keluh kesahmu dengan bahasa yang baik..." required></textarea>
    </div>

    <input type="text" name="_gotcha" style="display:none;" tabindex="-1" autocomplete="off">

    <button type="submit" class="but-kirim-saran">
      Kirim Pesan <i class="fa-solid fa-paper-plane"></i>
    </button>
  </form>
</div>

</div>
</section>
</main>
 @include('layouts.footer')
</body>
</html>
