const shopImage = document.getElementById("shopImage");
const shopOverlay = document.getElementById("shopOverlay");
const closeShopBtn = document.getElementById("closeShopBtn");
const belanja = document.getElementById("belanja");
const tutupBelanja = document.getElementById("tutupBelanja");
const menuUtama = document.getElementById("menuUtama");
const menuKustom = document.getElementById("menuKustom");
const menuMakan = document.getElementById("menuMakan");
const catImage = document.getElementById("catImage");

// Tampilkan dan tutup menu belanja
document.getElementById("shopImage").addEventListener("click", () => belanja.classList.remove("hidden"));
tutupBelanja.addEventListener("click", () => belanja.classList.add("hidden"))
// Navigasi menu
document.getElementById("btnMakanan").addEventListener("click", () => {
    menuUtama.classList.add("hidden");
    menuMakan.classList.remove("hidden");
});

document.getElementById("btnKustom").addEventListener("click", () => {
    menuUtama.classList.add("hidden");
    menuKustom.classList.remove("hidden");
});

document.getElementById("backToMenu").addEventListener("click", () => {
    menuKustom.classList.add("hidden");
    menuUtama.classList.remove("hidden");
});

document.getElementById("backToMenuMakan").addEventListener("click", () => {
    menuMakan.classList.add("hidden");
    menuUtama.classList.remove("hidden");
});

// beli item
const beliButtons = document.querySelectorAll('.beliBtn');
beliButtons.forEach(button => {
    button.addEventListener('click', function() {
        const id_produk = parseInt(this.getAttribute('data-id_produk')); // Ambil id_produk dari atribut data
        // const hargaItem = parseInt(this.getAttribute('hargaItem'));
        // ke php buat ngurangi koin
        console.log("Button clicked, id_produk: " + id_produk);
        fetch('beli.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id_produk: id_produk })
        })
        .then(response => response.json())
        .then(data => {
        
            alert(data.message);
            if (data.status === 'sukses') {
                tampilkanKoin();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

// Event listener untuk tombol beli
// document.querySelectorAll(".beliBtn").forEach(button => {
//     button.addEventListener("click", function() {
//         if (handlePurchase(this)) {
//             const motif = this.getAttribute("data-motif");
//             if (motif) {
//                 catImage.src = `img/motif${motif}/default_bayi${motif}.png`;
//             }
//         }
//     });
// });


