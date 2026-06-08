window.toggleKotak = function(elemen) {
    elemen.classList.toggle('aktif');
    let konten = elemen.querySelector('.kotak-konten');
    if (elemen.classList.contains('aktif')) {
        konten.style.maxHeight = konten.scrollHeight + "px";
    } else {
        konten.style.maxHeight = null;
    }
};