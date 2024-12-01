function updateLapar(amount) {
    fetch('ambilStatusBar.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Jaringan buruk');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data yg diterima: ', data);
            let currentLapar = parseInt(data.lapar);
            if (isNaN(currentLapar)) {
                console.error('currentLapar tidak valid, tidak dapat dikonversi ke angka');
                return;
            }

            if (currentLapar < 100) {
                currentLapar += amount;
                if (currentLapar > 100) {
                    currentLapar = 100; 
                    alert("Bar lapar sudah penuh!");
                }

                updateStatusOnServer(currentLapar, data.sehat, data.energi, data.senang);
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function updateStatusOnServer(lapar, sehat, energi, senang) {
    console.log('Updating status on server:', { lapar, sehat, energi, senang });
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


document.getElementById('makanButton1').addEventListener('click', function() {
    console.log('Button Makan 1 clicked');
    updateLapar(10);
});
document.getElementById('makanButton2').addEventListener('click', function() {
    console.log('Button Makan 2 clicked');
    updateLapar(10);
});
document.getElementById('makanButton3').addEventListener('click', function() {
    console.log('Button Makan 3 clicked');
    updateLapar(10);
});
document.getElementById('makanButton4').addEventListener('click', function() {
    console.log('Button Makan 4 clicked');
    updateLapar(10);
});
document.getElementById('makanButton5').addEventListener('click', function() {
    console.log('Button Makan 5 clicked');
    updateLapar(10);
});
document.getElementById('minumButton1').addEventListener('click', function() {
    console.log('Button Minum 1 clicked');
    updateLapar(5);
});
document.getElementById('minumButton2').addEventListener('click', function() {
    console.log('Button Minum 2 clicked');
    updateLapar(5);
});
document.getElementById('minumButton3').addEventListener('click', function() {
    console.log('Button Minum 3 clicked');
    updateLapar(5);
});