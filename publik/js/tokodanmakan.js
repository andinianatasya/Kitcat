
// Membeli item
document.querySelectorAll('.beliBtn').forEach(button => {
    button.addEventListener('click', function() {
        const produkId = this.id; // Mengambil ID produk dari tombol yang diklik
        const hargaItem = parseInt(this.getAttribute('hargaItem'));

        // Mengurangi koin dan memperbarui status produk
        fetch('beli.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ koin: hargaItem, produkId: produkId })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'sukses') {
                tampilkanKoin();
                updateProductStatus(produkId); // Memperbarui status produk di UI
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

// Fungsi untuk memperbarui status produk di UI
function updateProductStatus(produkId) {
    const button = document.getElementById(produkId);
    if (button) {
        button.disabled = false; // Mengaktifkan tombol jika produk dibeli
        button.classList.remove('opacity-50', 'cursor-not-allowed'); // Menghapus kelas untuk tampilan kunci
    }
}