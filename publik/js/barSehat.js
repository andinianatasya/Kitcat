document.getElementById('obatButton1').addEventListener('click', function() {
    updateSehat(10);
});

document.getElementById('obatButton2').addEventListener('click', function() {
    updateSehat(10);
});

document.getElementById('obatButton3').addEventListener('click', function() {
    updateSehat(10);
});

function updateSehat(amount) {
    let currentSehat = localStorage.getItem('sehat') || 100; 
    currentSehat = parseInt(currentSehat);

    if (currentSehat < 100) {
        currentSehat += amount;
        if (currentSehat > 100) {
            currentSehat = 100; 
            alert("Bar Sehat sudah penuh!");
        }
        localStorage.setItem('sehat', currentSehat);
    } 

    updateBarsDisplay(currentSehat, localStorage.getItem('lapar') || 100, localStorage.getItem('energi') || 100, localStorage.getItem('senang') || 100);
}