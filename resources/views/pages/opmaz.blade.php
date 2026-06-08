<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="Gentures23" />
    <meta
      name="keywords"
      content="Gentures, Gentures23, 23gentures, angkatan23,angkatan 23 Gentures, Gentures Al-Zaytun"
    />
    <title>Gentures</title>
    <link rel="shortcut icon" href="img/log_gen3.webp" />
    @vite(['resources/css/app.css', 'resources/js/scrollbutton.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  </head>
  <body class="opm">
  @include('layouts.nav') 
    <main class="opmaz-page-wrapper">
      
      <button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>

    <img src="{{ asset('img/opm.webp') }}" class="awalopmaz" alt="opmaz" loading="lazy" />

      <div class="judulopmaz">
        <h1>OPMAZ</h1>
        <p>Organisasi Pelajar Ma'had Al-Zaytun</p>
      </div>

      <section class="struktur-hero">
        <div class="struktur-hero-left">
          <span class="tagline">Struktural</span>
          <h1 class="title-utama">Organisasi Pelajar Ma'had Al-Zaytun</h1>
          <h2 class="title-sub">Dharma Bhakti ke-23</h2>
          <p class="deskripsi">
            Organisasi Pelajar Ma'had Al-Zaytun (OPMAZ) adalah wadah eksekutif santri untuk mengembangkan karakter kepemimpinan, kemandirian, dan keterampilan berorganisasi. Melalui Dharma Bhakti ke-23, kami berdedikasi penuh untuk menjalankan berbagai program progresif yang bermanfaat bagi seluruh civitas akademika dan masyarakat sekitar.
          </p>
        </div>

        <div class="struktur-hero-right">
          <div class="but"><a href="#pres">PRESIDEN</a></div>
          <div class="but"><a href="#kip">KIP</a></div>
          <div class="but"><a href="#ukas">UKASPM</a></div>
          <div class="but"><a href="#kemenditham">DITHAM</a></div>
          <div class="but"><a href="#kkplopm">KPL</a></div>
          <div class="but"><a href="#kemensora">KEMENSORA</a></div>
          <div class="but"><a href="#kkpuopm">KKPU</a></div>
          <div class="but"><a href="#uangopm">KEUANGAN</a></div>
          <div class="but"><a href="#ekoopm">EKONOMI</a></div>
          <div class="but"><a href="#kpstopm">KPST</a></div>
          <div class="but"><a href="#sekab">SEKAB</a></div>
          <div class="but"><a href="#ibadahopm">PERIBADATAN</a></div>
        </div>

      </section>

      <section class="bagan-container">
        
        <div id="pres" class="tier-presiden-wapres">
          
          <div class="eksekutif-cards-row">
            
            <div class="profil-card-eksekutif">
              <div class="img-wrapper-eks">
                <img src="{{ asset('img/pres.png') }}" alt="Presiden OPMAZ" /> </div>
              <h4>PRESIDEN</h4>
              <h3>Rafa Adliansyah Arizky</h3>
            </div>

            <div class="profil-card-eksekutif wapres">
              <div class="img-wrapper-eks">
                <img src="{{ asset('img/wapres.jpeg') }}" alt="Wakil Presiden OPMAZ" /> </div>
              <h4>WAKIL PRESIDEN</h4>
              <h3>Sherard Aryo Seto</h3>
            </div>

          </div>
          <div class="eksekutif-info-col">
            <h2>PRESIDEN & WAKIL PRESIDEN OPMAZ</h2>
            <p>Presiden & Wakil Presiden OPMAZ bertugas sebagai pucuk pimpinan eksekutif yang menentukan arah kebijakan organisasi, menjalankan program-program unggulan, serta menjadi teladan bagi seluruh anggota Angkatan 23.</p>
          </div>

        </div>

      <div class="kabinet">
        <span class="tagline">KEMENTERIAN</span>
        <h2 class="title" id="sekab">SEKRETARIS KABINET</h2>

      <div id="sekab" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/69.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Muhammad Naufal Firja</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/84.png') }}" alt="Bendahara" />
          </div>
          <div id="sekab" class="info-wrapper">
            <p>Orchida Meidina Putri</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/83.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Rasti Salsabila</p>
          </div>
        </div>
      </div>
</div>
<div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2 class="title">KEUANGAN</h2>

      <div id="uangopm" class="bagan-tier tier-4">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/76.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Panji Rachman Arrasyid</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/77.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Fira Novianti</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/78.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Amira Shofi Almadani</p>
          </div>
        </div>
      </div>
</div>
<div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2 class="title">URUSAN KERJASAMA ANTAR SEKOLAH, PELAJAR & MASYARAKAT</h2>

      <div id="ukas" class="bagan-tier tier-5">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/95.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Hafidz Azhar</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/90.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Nisrina Amalia</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/94.png') }}" alt="Humas" />
          </div> 
          <div class="info-wrapper">
            <p>Arham Bil Ikrom</p>
          </div>
        </div>
      </div>
</div>
<div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2 class="title">EKONOMI, PERDAGANGAN & KOPERASI</h2>

      <div id="ekoopm" class="bagan-tier tier-6">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/73.png') }}" alt="Wamen " />
          </div>
          <div class="info-wrapper">
            <p>Khikmatun Rizky Amalia</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/71.png') }}" alt="Menteri" />
          </div>
          <div class="info-wrapper">
            <p>Rais Annabiya</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/72.png') }}" alt="wamen" />
          </div>
          <div class="info-wrapper">
            <p>Panji Gumilang Syarifudin</p>
          </div>
        </div>
      </div>
</div>
<div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2  class="title">PERIBADATAN</h2>

      <div id="ibadahopm" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/70.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Dimas Maharanu Al-Fath</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/75.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Dinda Mesya Nurcasilia</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/74.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Alfiyyah Zahraa' Al Fajri</p>
          </div>
        </div>
      </div>
      </div>

      <div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2 class="title">PENEGAK DISIPLIN, TERTIB & PERLINDUNGAN HAK ASASI MANUSIA</h2>
      <div id="kemenditham" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/89.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Bangga Nur Arifin</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/87.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Ihsan Syatiri Ahmad</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/81.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Laela Puspitasari</p>
          </div>
        </div>
      </div>
      </div>
      <div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2 class="title">SENI & OLAHRAGA</h2>

      <div id="kemensora" class="bagan-tier tier-4">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/93.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Muhammad Dariel Ridho</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/91.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Cinta Kenia Al Mukti</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/92.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Adiban Rizqi</p>
          </div>
        </div>
      </div>
      </div>
      <div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2 class="title">KESEJAHTERAAN, KESEHATAN & PERBEKALAN UMUM</h2>

      <div id="kkpuopm" class="bagan-tier tier-4">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/1.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Rihanna Alfiyyah Rahma</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/2.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Alivin Ikhwan Suwandi</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/3.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Ali Haidar Azizi</p>
          </div>
        </div>
      </div>
      </div>
      <div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>

      <h2 class="title">PENDIDIKAN, SAINS & TEKNOLOGI</h2>

      <div id="kpstopm" class="bagan-tier tier-5">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/85.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Satrio Agung</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/79.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Nazilatul Atiqoh</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/80.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Putri Mutiara</p>
          </div>
        </div>
      </div>
      </div>
      <div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2 class="title">KEPANDUAN & PELESTARIAN LINGKUNGAN</h2>

      <div id="kkplopm" class="bagan-tier tier-6">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/66.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Zahra Al Karimah</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/64.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Muhammad Rizki Santausa</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/65.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Mufti Sofwan Fuad</p>
          </div>
        </div>
      </div>
      </div>
      <div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2 class="title">INFORMASI PUBLIKASI</h2>

      <div id="kip" class="bagan-tier tier-7">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/67.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Niswatun Nur Qolby</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/68.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Fardan Hanif Almadina</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/10.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Fatir Adli Alfariza</p>
          </div>
        </div>
      </div>
      </div>
      <div class="kabinet">
      <span class="tagline">KEMENTERIAN</span>
      <h2 class="title">PENGEMBANGAN BAHASA</h2>

      <div class="bagan-tier tier-8">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/82.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Nurul Batrisya</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/88.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Muhammad Ridho Ashidik</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/86.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Fatih Izzudin</p>
          </div>
        </div>
      </div>
      </div>
      @include('layouts.footer')
    </main>
  </body>
</html>
