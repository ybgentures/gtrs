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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  </head>
  <body>
@include('layouts.nav')
  <main class="mpk-page-wrapper">
    <img src="{{ asset('img/empeka.webp') }}" class="awalmpk" alt="mpk" loading="lazy" />

    <div class="judulmpk">
        <h1>MPK</h1>
        <p>Majelis Perwakilan Kelas Angkatan 23 Gentures</p>
      </div>

    <section class="mpk-hero">
      
      <div class="mpk-hero-left">
        <span class="tagline">STRUKTURAL</span>
        <h1 class="title-utama">Majelis Perwakilan Kelas</h1>
        <h2 class="title-sub">Gentures</h2>
        <p class="deskripsi">
          Majelis Perwakilan Kelas (MPK) merupakan badan legislatif pelajar yang memiliki peran penting dalam mengawasi, mengevaluasi, serta menampung aspirasi seluruh anggota Angkatan 23 Gentures. Kami berkomitmen untuk mewujudkan sinergi dan integritas demi kemajuan bersama di lingkungan Ma'had Al-Zaytun.
        </p>
      </div>

      <div class="mpk-hero-right">
        <div class="but"><a href="#mpkketua">KETUA</a></div>
        <div class="but"><a href="#mpkip">IP</a></div>
        <div class="but"><a href="#mpkhumas">HUMAS</a></div>
        <div class="but"><a href="#mpkditham">DITHAM</a></div>
        <div class="but"><a href="#mpkpramuka">KPL</a></div>
        <div class="but"><a href="#mpksora">MULOK</a></div>
        <div class="but"><a href="#mpkkkpu">KKPU</a></div>
        <div class="but"><a href="#mpkuang">KEUANGAN</a></div>
        <div class="but"><a href="#mpkeko">EKONOMI</a></div>
        <div class="but"><a href="#mpkpst">EKSKUL</a></div>
        <div class="but"><a href="#mpksekre">SEKRETARIS</a></div>
        <div class="but"><a href="#mpkibadah">PERIBADATAN</a></div>
        <div class="but"><a href="#mpkbahasa">KEBAHASAAN</a></div>
      </div>

    </section>

    <section class="bagan-container">
      
      <button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
      
      <div id="mpkketua" class="bagan-tier tier-ketua">
        <div class="profil-card-horizontal">
          <div class="img-wrapper-horizontal">
            <img src="{{ asset('img/4.png') }}" alt="Ketua MPK" />
          </div>
          <div class="info-wrapper-horizontal">
            <h4>KETUA MPK</h4>
            <h3>Muhammad Farhan Al Huda</h3>
          </div>
        </div>
      </div>
      <div class="bagan-tier tier-2">
        <div class="wakilketua">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/2.png') }}" alt="Wakil 1" />
          </div>
          <div class="info-wrapper">
            <h4>WAKIL KETUA 1</h4>
            <p>Muhammad Fajar Al Hakim</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/5.png') }}" alt="Wakil 2" />
          </div>
          <div class="info-wrapper">
            <h4>WAKIL KETUA 2</h4>
            <p>Alfinza Aulia Ramadhanis</p>
          </div>
        </div>
      <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/3.png') }}" alt="Wakil 3" />
          </div>
          <div class="info-wrapper">
            <h4>WAKIL KETUA 3</h4>
            <p>Arham Bil Ikrom</p>
          </div>
        </div>
      <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/1.png') }}" alt="Wakil 4" />
          </div>
          <div class="info-wrapper">
            <h4>WAKIL KETUA 4</h4>
            <p>Ayunik Nuri Salma</p>
          </div>
        </div>
      </div>
      </div>
      <h2 class="title">SEKRETARIS</h2>

      <div id="mpksekre" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/8.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Fajri Khairun Nashir</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/48.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Lutfiyani Arifatun Khasanah</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/13.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Fathurrahman Aulia Sidqi</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/47.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Kamelia Rana</p>
          </div>
        </div>
      </div>

      <h2 class="title">KEUANGAN</h2>

      <div id="mpkuang" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/14.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Muhammad Fahrurozy Al Ghifary</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/16.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Ihsan Firmansyah</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/36.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Madinah Nur Islamiah</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/21.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Alvin Ikhwan Suwandi</p>
          </div>
        </div>
      </div>

      <h2 class="title">HUBUNGAN MASYARAKAT</h2>

      <div id="mpkhumas" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/11.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Rafi Ahmad Ramadhan</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/35.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Elecia Okta Dinata</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/22.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Ali Haidar Azizi</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/59.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Hafidz Azhar</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/45.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Masyitoh</p>
          </div>
        </div>
      </div>

      <h2 class="title">EKONOMI</h2>

      <div id="mpkeko" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/17.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Addy Birroka</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/41.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Mesha Vrischika Lestari</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/52.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Nisrina Amalia</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/18.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Ridwan Al Faras</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/37.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Shofia Nur Madani</p>
          </div>
        </div>
      </div>

      <h2  class="title">PERIBADATAN</h2>

      <div id="mpkibadah" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/54.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Teghar Ramadhan Sofyan</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/55.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Salma Aulia Rahma</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/15.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Dimas Maharanu Al-Fath</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/25.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Albas Septiar Ramadhan</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/44.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Intan Almadaniah</p>
          </div>
        </div>
      </div>

      <h2 class="title">KEDISIPLINAN</h2>

      <div id="mpkditham" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/34.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Dewi Sri Elmira</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/40.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Renata Kusuma Nariswari</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/9.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Rafa Adliansyah Arizky</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/26.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Ikhsan Fadillah</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/61.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Laela Puspitasari</p>
          </div>
        </div>
      </div>

      <h2 class="title">SENI DAN OLAHRAGA</h2>

      <div id="mpksora" class="bagan-tier tier-4">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/28.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Firzan Arriziq</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/49.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Putri Aldina</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/27.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Adiban Rizqi</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/51.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Zahra Al Karimah</p>
          </div>
        </div>
      </div>

      <h2 class="title">KKPU</h2>

      <div id="mpkkkpu" class="bagan-tier tier-3">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/30.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Johan Syawal</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/50.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Milki Matus Salehah</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/24.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Imam Farish Ahzam</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/7.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Bilqis Fajri</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/57.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Zaarif Ikhwan</p>
          </div>
        </div>
      </div>

      <h2 class="title">PENDIDIKAN</h2>

      <div id="mpkpst" class="bagan-tier tier-5">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/39.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Adlina Mu'thiya Hazima</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/6.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Pasha Hanan Ramaditya</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/31.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Thalut Al-Malik</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/56.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Johan Ramadhan</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/60.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Fira Novianti</p>
          </div>
        </div>
      </div>

      <h2 class="title">KEPRAMUKAAN</h2>

      <div id="mpkpramuka" class="bagan-tier tier-6">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/23.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Farid Nasrul Haq</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/46.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Syafiah Shofa Asilah</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/29.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Mufti Sofwan Fuad</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/53.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Kayla Alisya Zadina</p>
          </div>
        </div>
      </div>

      <h2 class="title">INFORMASI DAN DOKUMENTASI</h2>

      <div id="mpkip" class="bagan-tier tier-7">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/33.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Amiara Husna</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/12.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Fardan Hanif Almadina</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/32.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Tazakka Siyami Fauzi</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/19.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Ahmed Deedad Sadli</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/43.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Niswatun Nur Qolby</p>
          </div>
        </div>
      </div>

      <h2 class="title">KEBAHASAAN</h2>

      <div id="mpkbahasa" class="bagan-tier tier-8">
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/38.png') }}" alt="Sekretaris" />
          </div>
          <div class="info-wrapper">
            <p>Fizura Syahlan Ahfa</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/20.png') }}" alt="Bendahara" />
          </div>
          <div class="info-wrapper">
            <p>Rais Annabiya</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/10.png') }}" alt="Humas" />
          </div>
          <div class="info-wrapper">
            <p>Muhammad Ridho Ashidik</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/58.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Abdussalam Rasyidi Damar Panuluh</p>
          </div>
        </div>
        <div class="profil-card">
          <div class="img-wrapper">
            <img src="{{ asset('img/42.png') }}" alt="IP" />
          </div>
          <div class="info-wrapper">
            <p>Nurul Batrisya</p>
          </div>
        </div>
      </div>
    </main> 
  </body>
</html>
