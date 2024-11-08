const shopImage = document.getElementById("shopImage");
const shopOverlay = document.getElementById("shopOverlay");
const closeShopBtn = document.getElementById("closeShopBtn");
let jumlahKoin = 1000
document.addEventListener('DOMContentLoaded', function() {
const belanja = document.getElementById("belanja");
const jumlahKoinEl = document.getElementById("jumlahKoin");
const tutupBelanja = document.getElementById("tutupBelanja");
const menuUtama = document.getElementById("menuUtama");
const menuKustom = document.getElementById("menuKustom");
const menuMakan = document.getElementById("menuMakan");
const catImage = document.getElementById("catImage");
let jumlahKoin = 1000
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

//untuk memperbarui tampilan koin
const updateCoinDisplay = () => {
    jumlahKoinEl.textContent = jumlahKoin;
};

// Pembelian item
const handlePurchase = (button) => {
    const harga = parseInt(button.getAttribute("hargaItem"));
    if (jumlahKoin >= harga) {
        jumlahKoin -= harga;
        alert("Anda telah membeli dengan harga " + harga + " koin");
        updateCoinDisplay();
        return true;
    } else {
        alert("Koin anda tidak cukup untuk membeli ini!");
        return false;
    }
};

// Event listener untuk tombol beli
document.querySelectorAll(".beliBtn").forEach(button => {
    button.addEventListener("click", function() {
        if (handlePurchase(this)) {
            const motif = this.getAttribute("data-motif");
            if (motif) {
                catImage.src = `img/motif${motif}/default_bayi${motif}.png`;
            }
        }
    });
});

updateCoinDisplay();
});