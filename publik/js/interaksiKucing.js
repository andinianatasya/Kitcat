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

// kucing jadi tidur
function changeCatImage() {
    catImage.src = "img/ngantuk_bayi.png"; //ganti nanti
}
sabunImage.addEventListener("click", changeCatImage);
showerImage.addEventListener("click", changeCatImage);
