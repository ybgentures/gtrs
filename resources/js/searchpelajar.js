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