function decreaseAllStatusBars() { 
    fetch('ambilStatusBar.php')
        .then(response => response.json())
        .then(data => {
    
            let currentLapar = Math.max(0, data.lapar - 1);
            let currentSehat = Math.max(0, data.sehat - 1);
            let currentEnergi = Math.max(0, data.energi - 1);
            let currentSenang = Math.max(0, data.senang - 1);

            updateBarsDisplay(currentLapar, currentSehat, currentEnergi, currentSenang);

            updateStatusOnServer(currentLapar, currentSehat, currentEnergi, currentSenang);
        })
        .catch(error => {
            console.error('Error fetching status:', error);
        });
}

// Fungsi untuk memperbarui tampilan status bar di UI
function updateBarsDisplay(lapar, sehat, energi, senang) {
    document.getElementById('status_bar_lapar').style.width = lapar + '%';
    document.getElementById('laparBar').textContent = lapar + '%';

    document.getElementById('status_bar_sehat').style.width = sehat + '%';
    document.getElementById('sehatBar').textContent = sehat + '%';

    document.getElementById('status_bar_energi').style.width = energi + '%';
    document.getElementById('energiBar').textContent = energi + '%';

    document.getElementById('status_bar_senang').style.width = senang + '%';
    document.getElementById('senangBar').textContent = senang + '%';
}

function updateStatusOnServer(lapar, sehat, energi, senang) {
    fetch('updateBar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ lapar, sehat, energi, senang })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Status updated successfully:', data);
    })
    .catch(error => {
        console.error('Error updating status on server:', error);
    });
}

setInterval(decreaseAllStatusBars, 5000);

window.onload = function() {
    fetch('ambilStatusBar.php')
        .then(response => response.json())
        .then(data => {
            updateBarsDisplay(data.lapar, data.sehat, data.energi, data.senang);
        })
        .catch(error => {
            console.error('Error fetching initial status:', error);
        });
};