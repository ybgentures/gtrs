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