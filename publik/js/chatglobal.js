///////buka chat global
document.getElementById("bukaChat").addEventListener("click", () => {
    sessionStorage.setItem("previousPage", window.location.href);
    window.location.href = "globalChat.html"; // Mengarahkan ke halaman chat global
});
////////tutup chat global
function closeChat() {
    const previousPage = sessionStorage.getItem("previousPage");
    if (previousPage) {
        window.location.href = previousPage; // Kembali ke halaman sebelumnya
    } else {
        window.location.href = "beranda.html"; // Default jk gda halaman sebelumnya
    }
}
