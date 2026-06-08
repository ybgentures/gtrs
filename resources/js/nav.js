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