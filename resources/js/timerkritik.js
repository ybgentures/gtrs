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