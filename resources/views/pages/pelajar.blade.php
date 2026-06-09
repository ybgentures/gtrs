<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Gentures23" />
  <meta name="keywords" content="Gentures, Gentures23, 23gentures, angkatan23, Gentures Al-Zaytun" />
  <title>Member of Gentures</title>
  <link rel="shortcut icon" href="{{ asset('img/log_gen3.webp') }}" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <style>
    /* CSS Khusus Tombol Load More (Dasar KEPO) */
    .load-more-container {
      text-align: center;
      margin-top: 40px;
      margin-bottom: 20px;
      grid-column: 1 / -1; /* Memastikan tombol memanjang di tengah bawah */
      width: 100%;
    }
    .btn-kepo {
      background: linear-gradient(135deg, #ffcc00, #ff9900);
      color: #002e5f;
      border: none;
      padding: 15px 40px;
      font-size: 1.1rem;
      font-weight: 800;
      border-radius: 30px;
      cursor: pointer;
      box-shadow: 0 10px 20px rgba(255, 153, 0, 0.3);
      transition: all 0.3s ease;
    }
    .btn-kepo:hover {
      transform: translateY(-5px) scale(1.05);
      box-shadow: 0 15px 25px rgba(255, 153, 0, 0.5);
      background: linear-gradient(135deg, #ffdd33, #ffaa00);
    }
    .btn-kepo i {
      margin-left: 8px;
    }
  </style>
</head>
<body>

  @include('layouts.nav')

  <main class="halaman-pelajar-main" style="padding-top: 120px;">
    
    <section class="member-header-section">
      <h1 class="member-title">Member of Gentures</h1>
      <h2 class="member-count"><strong>488 Members</strong></h2>
      
      <div class="search-box-container">
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass search-icon"></i>
          <input type="text" id="searchInput" onkeyup="filterMember()" placeholder="Cari nama temanmu di sini...">
        </div>
      </div>
    </section>

    <section class="member-grid-section">
      <div class="member-grid" id="memberGrid">
        
        @forelse ($data_pelajar as $row)
    
            <div class="member-card">
                <div class="member-img-wrapper">
                    <img src="{{ asset('img/' . ($row->foto ?: 'default.jpg')) }}" alt="{{ $row->nama_lengkap }}" loading="lazy">
                </div>
                <h4 class="member-name">{{ $row->nama_lengkap }}</h4>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px; color: var(--nav-color); font-weight: 600;">
                <p><i class="fa-solid fa-folder-open" style="font-size: 2.5rem; margin-bottom: 10px;"></i><br>Belum ada data teman yang dimasukkan ke dalam database.</p>
            </div>
        @endforelse

      </div>
      
      <div class="load-more-container" id="loadMoreContainer" style="display: none;">
        <button class="btn-kepo" onclick="loadMore()">Tombol buat orang Kepo <i class="fa-solid fa-eye"></i></button>
      </div>

      <div id="noResultMessage" style="display: none; text-align: center; padding: 40px; color: #666; grid-column: 1 / -1; width: 100%;">
        <h3>Yah, nama teman yang kamu cari tidak ditemukan 😔</h3>
      </div>
    </section>

  </main>

</body>
</html>