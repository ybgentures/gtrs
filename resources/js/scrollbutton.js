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