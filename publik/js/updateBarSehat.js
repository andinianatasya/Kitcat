function updateSehat(amount) {
    fetch('ambilStatusBar.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Jaringan buruk');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data yg diterima: ', data);
            let currentSehat = parseInt(data.sehat);
            if (isNaN(currentSehat)) {
                console.error('currentSehat tidak valid, tidak dapat dikonversi ke angka');
                return;
            }

            if (currentSehat < 100) {
                currentSehat += amount;
                if (currentSehat > 100) {
                    currentSehat = 100; 
                    alert("Bar sehat sudah penuh!");
                }

                updateStatusOnServer(data.lapar, currentSehat, data.energi, data.senang);
            }
        })
        .catch(error => {
            console.error('Error', error);
        });
}

function updateStatusOnServer(lapar, sehat, energi, senang) {
    console.log('Update status', { lapar, sehat, energi, senang });
    fetch('updateBar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ lapar, sehat, energi, senang })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Jaringan buruk');
        }
        return response.json();
    })
    .then(() => {
        updateBarsDisplay(lapar, sehat, energi, senang);
    })
    .catch(error => {
        console.error('Terjadi masalah', error);
    });
}


document.getElementById('obatButton1').addEventListener('click', function() {
    console.log('Button Obat 1 clicked');
    updateSehat(10);
});
document.getElementById('obatButton2').addEventListener('click', function() {
    console.log('Button Obat 2 clicked');
    updateSehat(10);
});
document.getElementById('obatButton3').addEventListener('click', function() {
    console.log('Button Obat 3 clicked');
    updateSehat(10);
});
