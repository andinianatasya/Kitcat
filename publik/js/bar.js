
function decreaseAllStatusBars() { 
    let currentLapar = localStorage.getItem('lapar') || 100;
    let currentSehat = localStorage.getItem('sehat') || 100;
    let currentEnergi = localStorage.getItem('energi') || 100;
    let currentSenang = localStorage.getItem('senang') || 100;
    currentLapar = parseInt(currentLapar);
    currentSehat = parseInt(currentSehat);
    currentEnergi = parseInt(currentEnergi);
    currentSenang = parseInt(currentSenang);
    if (currentLapar > 0) currentLapar--;
    if (currentSehat > 0) currentSehat--;
    if (currentEnergi > 0) currentEnergi--;
    if (currentSenang > 0) currentSenang--;

    // Menyimpan nilai baru ke Local Storage
    localStorage.setItem('lapar', currentLapar);
    localStorage.setItem('sehat', currentSehat);
    localStorage.setItem('energi', currentEnergi);
    localStorage.setItem('senang', currentSenang);

    // Memperbarui tampilan bar
    updateBarsDisplay(currentLapar, currentSehat, currentEnergi, currentSenang);
}
// untuk memperbarui tampilan bar
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
setInterval(decreaseAllStatusBars, 60000);

window.onload = function() {
    updateBarsDisplay(
        localStorage.getItem('lapar') || 100,
        localStorage.getItem('sehat') || 100,
        localStorage.getItem('energi') || 100,
        localStorage.getItem('senang') || 100
    );
};