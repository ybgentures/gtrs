window.copyRekening = function() {
    const rekBCA = document.getElementById("rekBCA");
    if (rekBCA) {
        const nomorRekening = rekBCA.innerText;
        navigator.clipboard.writeText(nomorRekening).then(() => {
            alert("Nomor rekening " + nomorRekening + " berhasil disalin!");
        }).catch(err => {
            alert("Gagal menyalin, silakan catat manual: " + nomorRekening);
        });
    }
};

window.downloadQRIS = function() {
    const qrisImg = document.getElementById('qrisImage');
    if (qrisImg) {
        const downloadLink = document.createElement('a');
        downloadLink.href = qrisImg.src;
        downloadLink.download = 'QRIS-Donasi-Gentures23.png';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
};

window.downloadQRISAdmin = function() {
    const qrisImgAdmin = document.getElementById('qrisAdmin');
    if (qrisImgAdmin) {
        const downloadLinkAdmin = document.createElement('a');
        downloadLinkAdmin.href = qrisImgAdmin.src;
        downloadLinkAdmin.download = 'QRIS-Kopi-Admin.png';
        document.body.appendChild(downloadLinkAdmin);
        downloadLinkAdmin.click();
        document.body.removeChild(downloadLinkAdmin);
    }
};

// ==========================================
// 1. FUNGSI POPUP SAPAAN
// ==========================================
window.tutupPopup = function() {
    const popup = document.getElementById('popup-sapaan');
    if (popup) { // Jaring pengaman: Pastikan popup ada di halaman
        popup.style.opacity = '0'; // Animasi memudar
        setTimeout(() => { popup.style.display = 'none'; }, 300); // Hilang setelah 0.3 detik
    }
}

// ==========================================
// 2. FUNGSI SIDEBAR / NAVBAR
// ==========================================
window.showSidebar = function(event) {
    const sidebar = document.getElementById("mySidebar");
    if (sidebar) { // Jaring pengaman
        event.stopPropagation(); 
        sidebar.classList.add("active");
    }
}

window.hideSidebar = function() {
    const sidebar = document.getElementById("mySidebar");
    if (sidebar) {
        sidebar.classList.remove("active");
    }
}

// Menutup sidebar jika pengguna mengklik area luar
document.addEventListener("click", function(event) {
    const sidebar = document.getElementById("mySidebar");
    const menuBtn = document.getElementById("menuBtn");

    // Pastikan sidebar ada dan sedang aktif (terbuka)
    if (sidebar && sidebar.classList.contains("active")) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnMenuBtn = menuBtn ? menuBtn.contains(event.target) : false;

        // Jika klik bukan pada sidebar dan bukan pada tombol menu, tutup sidebar!
        if (!isClickInsideSidebar && !isClickOnMenuBtn) {
            hideSidebar();
        }
    }
});        

window.topFunction = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' }); // Langsung ke atas (0)
};

window.addEventListener('scroll', function() {
    let mybutton = document.getElementById("myBtn");
    if (mybutton) { // Cek jika tombol scroll ada di halaman ini
        // Munculkan tombol jika scroll lebih dari 800px ke bawah
        if (document.body.scrollTop > 800 || document.documentElement.scrollTop > 800) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
});

let currentLimit = 20; 
const addAmount = 200;  

// Harus tetap global agar bisa dipanggil fungsi di bawahnya
window.updateVisibility = function() {
    let grid = document.getElementById('memberGrid');
    if (!grid) return; // Jika bukan halaman pelajar, hentikan fungsi
    
    let cards = grid.getElementsByClassName('member-card');
    let loadMoreBtn = document.getElementById('loadMoreContainer');
    let totalCards = cards.length;
    
    for (let i = 0; i < totalCards; i++) {
        cards[i].style.display = (i < currentLimit) ? "" : "none";
    }
    
    if (loadMoreBtn) {
        loadMoreBtn.style.display = (currentLimit < totalCards) ? "block" : "none";
    }
};

document.addEventListener("DOMContentLoaded", function() {
    window.updateVisibility();
});

window.loadMore = function() {
    currentLimit += addAmount; 
    window.updateVisibility();        
};

window.filterMember = function() {
    let input = document.getElementById('searchInput');
    if (!input) return;

    let filter = input.value.toLowerCase();
    let grid = document.getElementById('memberGrid');
    let cards = grid.getElementsByClassName('member-card');
    let noResult = document.getElementById('noResultMessage');
    let loadMoreBtn = document.getElementById('loadMoreContainer');
    let matchCount = 0;

    if (filter === "") {
        window.updateVisibility();
        if (noResult) noResult.style.display = "none";
        return;
    }

    if (loadMoreBtn) loadMoreBtn.style.display = "none";

    for (let i = 0; i < cards.length; i++) {
        let nameElement = cards[i].getElementsByClassName('member-name')[0];
        if (nameElement) {
            let textValue = nameElement.textContent || nameElement.innerText;
            if (textValue.toLowerCase().indexOf(filter) > -1) {
                cards[i].style.display = ""; 
                matchCount++;
            } else {
                cards[i].style.display = "none"; 
            }
        }
    }
    
    if (noResult) {
        noResult.style.display = (matchCount === 0) ? "block" : "none";
    }
};

document.addEventListener('contextmenu', function(e) {
    if (e.target.nodeName === 'IMG') e.preventDefault();
});

const formSaran = document.getElementById('formSaran');

if (formSaran) { // CEK AMAN: Hanya jalan di halaman yang ada formulirnya
    formSaran.addEventListener('submit', function(event) {
        const pesanInput = document.getElementById('pesan');
        if (!pesanInput) return;
        
        const pesan = pesanInput.value.toLowerCase();
        const kataTerlarang = ['judi', 'slot', 'kasino', 'bodoh', 'anjing', 'http://'];
        
        for (let i = 0; i < kataTerlarang.length; i++) {
            if (pesan.includes(kataTerlarang[i])) {
                alert('⚠️ Pesanmu tidak dapat dikirim karena mengandung kata yang tidak pantas atau link mencurigakan.');
                event.preventDefault(); 
                return; 
            }
        }

        const waktuTerakhir = localStorage.getItem('waktuKirimSaran');
        const waktuSekarang = new Date().getTime();
        const jedaMiliDetik = 10 * 60 * 1000;

        if (waktuTerakhir) {
            const selisihWaktu = waktuSekarang - parseInt(waktuTerakhir);
            if (selisihWaktu < jedaMiliDetik) {
                const totalSisaDetik = Math.ceil((jedaMiliDetik - selisihWaktu) / 1000);
                const sisaMenit = Math.floor(totalSisaDetik / 60);
                const sisaDetik = totalSisaDetik % 60;
                
                let teksWaktu = "";
                if (sisaMenit > 0) teksWaktu += sisaMenit + " menit ";
                if (sisaDetik > 0 || sisaMenit === 0) teksWaktu += sisaDetik + " detik";

                alert(`⏳ Tunggu sebentar! Kamu baru saja mengirim pesan. Harap tunggu ${teksWaktu} lagi.`);
                event.preventDefault(); 
                return;
            }
        }
        localStorage.setItem('waktuKirimSaran', waktuSekarang.toString());
    });
}

window.toggleKotak = function(elemen) {
    elemen.classList.toggle('aktif');
    let konten = elemen.querySelector('.kotak-konten');
    if (elemen.classList.contains('aktif')) {
        konten.style.maxHeight = konten.scrollHeight + "px";
    } else {
        konten.style.maxHeight = null;
    }
};
