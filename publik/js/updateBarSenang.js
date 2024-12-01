function updateSenang(amount) {
    fetch('ambilStatusBar.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Jaringan buruk');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data yg diterima: ', data);
            let currentSenang = parseInt(data.senang);
            if (isNaN(currentSenang)) {
                console.error('currentSenang tidak valid, tidak dapat dikonversi ke angka');
                return;
            }

            if (currentSenang < 100) {
                currentSenang += amount;
                if (currentSenang > 100) {
                    currentSenang = 100; 
                    alert("Bar senang sudah penuh!");
                }

                updateStatusOnServer(data.lapar, data.sehat, data.energi, currentSenang);
            }
        })
        .catch(error => {
            console.error('Error', error);
        });
}

function updateStatusOnServer(lapar, sehat, energi, senang) {
    console.log('Update status: ', { lapar, sehat, energi, senang });
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

document.getElementById('senang1').addEventListener('click', function(event) {
    event.preventDefault();
    console.log('Button Senang 1 clicked');
    updateSenang(10);
    

    window.location.href = "bahasapemrograman.html";
});

document.getElementById('senang2').addEventListener('click', function(event) {
    event.preventDefault();
    console.log('Button Senang 2 clicked');
    updateSenang(10);
    
    window.location.href = "bahasastandar.html";
});