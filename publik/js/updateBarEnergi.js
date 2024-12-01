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
            let currentEnergi = parseInt(data.energi);
            if (isNaN(currentEnergi)) {
                console.error('currentEnergi tidak valid, tidak dapat dikonversi ke angka');
                return;
            }

            if (currentEnergi <= 50) {
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
    const overlay = document.getElementById('matiLampu');
    const closeButton = document.getElementById('closeButton');
    const catImage = document.getElementById('catImage');

    if (currentEnergi >= 50) {
        energiButton.classList.add('opacity-50', 'cursor-not-allowed');
        energiButton.setAttribute('aria-disabled', 'true');
        energiButton.disabled = true;
        message.classList.remove('hidden');
        message.classList.add('block');

        overlay.classList.add('hidden');
        catImage.src = 'img/default_bayi.png';

        
        setTimeout(() => {
            message.classList.add('hidden');
            message.classList.remove('block');
        }, 2000);
        
    } else {
        energiButton.classList.remove('opacity-50', 'cursor-not-allowed');
        energiButton.removeAttribute('aria-disabled');
        energiButton.disabled = false;
        message.classList.add('hidden');

        overlay.classList.remove('hidden');
        closeButton.classList.remove('hidden');
        catImage.src = 'img/tidur_bayi.png';

        closeButton.addEventListener('click', function() {
            overlay.classList.add('hidden');
            closeButton.classList.add('hidden');
            catImage.src = 'img/default_bayi.png';
        });
    }
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

document.getElementById('lampu').addEventListener('click', function() {
    const energiButton = this;
    if (energiButton.disabled) {
        console.log('Tombol dinonaktifkan, tidak dapat menambah energi.');
        return; 
    }

    console.log('Button Tidur clicked');
    updateEnergi(15);
});
