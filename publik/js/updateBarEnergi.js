function updateEnergi(amount) {
    fetch('ambilStatusBar.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Jaringan buruk');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data yang diterima: ', data);
            let currentEnergi = data.energi;

            if (currentEnergi < 100) {
                currentEnergi += amount;
                if (currentEnergi > 100) {
                    currentEnergi = 100; 
                    alert("Bar energi sudah penuh!");
                }

                updateStatusOnServer(data.lapar, data.sehat, currentEnergi, data.senang);
            }
            toggleEnergiButtons(currentEnergi);
        })
        .catch(error => {
            console.error('Error', error);
        });
}

function toggleEnergiButtons(currentEnergi) {
    const energiButton = document.getElementById('lampu');
    const message = document.getElementById('message');

    if (currentEnergi >= 50) {
        energiButton.classList.add('opacity-50', 'cursor-not-allowed');
        energiButton.disabled = true;
        message.classList.remove('hidden');
        message.classList.add('block');
    } else {
        energiButton.classList.remove('opacity-50', 'cursor-not-allowed');
        energiButton.disabled = false;
        message.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('lampu').classList.add('energi-button');
    document.getElementById('lampu').addEventListener('click', function() {
        console.log('Button Tidur clicked');
        updateEnergi(20);
    });
});

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