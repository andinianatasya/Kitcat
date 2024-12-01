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
=======
sabunImage.addEventListener("click", changeCatImage);
showerImage.addEventListener("click", changeCatImage);

// js button kunci di ruangmkn.html
    const buttons = document.querySelectorAll('.makan');
    buttons.forEach(button => {
        const id_produk = parseInt(this.getAttribute('konsumsi'));
        console.log("Button clicked, id_produk: " + id_produk);
        button.addEventListener('click', () => {
            // Mengirim permintaan POST ke konsumsi.php
            fetch('konsumsi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id_produk: id_produk })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Menampilkan pesan dari server

                // Jika produk dihapus, nonaktifkan tombol
                if (data.status === 'sukses' && data.message.includes("dihapus")) {
                    button.disabled = true;
                    button.classList.add('opacity-50', 'cursor-not-allowed');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
