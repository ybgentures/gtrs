<head>
  @vite(['resources/css/app.css', 'resources/js/nav.js'])
</head>
<header>
  <nav class="navbar">
    <div class="navdiv">
      
      <div class="logo-div">
        <a href="/"><img src="{{ asset('img/log_gen3.webp') }}" alt="Logo Gentures" loading="eager" /></a>
        <a href="/" class="dlogo">GENTURES</a>
      </div>
      
      <ul class="nav-links" id="navMenu">
        <li class="hideOnMobile"><a href="/" class="tmbl">Beranda</a></li>
        <li class="hideOnMobile"><a href="/zaytun" class="tmbl">Al-Zaytun</a></li>
        
        <li class="hideOnMobile">
          <a href="/donasi" class="btn-donasi-nav">Support <i class="fa-solid fa-hand-holding-heart"></i></a>
        </li>
        
        @if (session()->has('nama') && session('role') == 'member')
          <li class="hideOnMobile">
            <img src="{{ asset('img/' . (session('foto') ?: 'default.jpg')) }}" class="foto-profil-nav" alt="Profil">
          </li>
        @else
          <li class="hideOnMobile">
            <a href="/login" class="btn-login-nav">Login</a>
          </li>
        @endif

        <li onclick="showSidebar(event)" id="menuBtn">
          <button class="menu-sidebar">
            <img src="{{ asset('img/tmenu.png') }}" alt="Menu" style="width: 25px;"> 
          </button>
        </li>
      </ul>

      <ul class="sidebar" id="mySidebar">
        <li onclick="hideSidebar()"></li>
        <li><a href="/" class="tmbl">Beranda</a></li>
        <li><a href="/zaytun" class="tmbl">Al-Zaytun</a></li>
        
        <li><a href="/donasi" class="btn-donasi-sidebar">Support <i class="fa-solid fa-hand-holding-heart"></i></a></li>
        
        @if (session('role') == 'member')
          <li><a href="/logout" class="btn-logout-sidebar">Logout <i class="fa-solid fa-right-from-bracket"></i></a></li>
        @else
          <li><a href="/login" class="btn-login-sidebar">Login <i class="fa-solid fa-right-to-bracket"></i></a></li>
        @endif
      </ul>

    </div>
  </nav>
</header>

@if (session('baru_login'))

    <div id="popup-sapaan" class="popup-overlay">
        <div class="popup-kaca">
            <button onclick="tutupPopup()" class="btn-silang"><i class="fa-solid fa-xmark"></i></button>
            
            <!-- Memanggil foto dan nama menggunakan fungsi asset dan session Laravel -->
            <img src="{{ asset('img/' . (session('foto') ?: 'default.jpg')) }}" alt="Foto" class="popup-foto">
            <h2>Hai, {{ session('nama') }}!</h2>
            
        </div>
    </div>

    <!-- PENTING: Hapus stempel menggunakan Blade agar tidak muncul lagi saat di-refresh -->
    @php
        session()->forget('baru_login');
    @endphp

@endif
