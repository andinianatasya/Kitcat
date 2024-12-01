// deklarasi variable
const suaraMeong = document.getElementById("meong");
const catImage = document.getElementById("catImage");
const sabunImage = document.querySelector('img[alt="sabun"]');
const showerImage = document.querySelector('img[alt="shower"]');
//////////Meong kucing


// suara kucing ketika di click
catImage.addEventListener('click', function() {
    if (suaraMeong) {
        suaraMeong.play()
            .then(() => console.log('Memutar audio'))
            .catch(error => console.error('Gagal memutar audio:', error));
    } else {
        console.error('Audio tidak ditemukan');
    }
});

// Fungsi untuk mengganti gambar kucing
function changeToSabun() {
    catImage.src = "img/kucing_sabun.png"; // Ganti gambar menjadi kucing terkena sabun
}

function changeToShower() {
    catImage.src = "img/kucing_basah.png"; // Ganti gambar menjadi kucing basah
}

// Menambahkan event listener ke ikon sabun dan shower
sabunImage.addEventListener("click", changeToSabun);
showerImage.addEventListener("click", changeToShower);
