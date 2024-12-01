function tampilkanKoin() {
    fetch('simpanKoin.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'sukses') {
                document.getElementById('jumlahKoin').innerText = data.koin;
            } else {
                console.error(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

document.addEventListener('DOMContentLoaded', tampilkanKoin);