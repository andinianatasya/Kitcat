document.getElementById('makanButton1').addEventListener('click', function() {
updateLapar(10);
});

document.getElementById('makanButton2').addEventListener('click', function() {
    updateLapar(10);
});

document.getElementById('makanButton3').addEventListener('click', function() {
    updateLapar(10);
});

document.getElementById('makanButton4').addEventListener('click', function() {
    updateLapar(10);
});

document.getElementById('makanButton5').addEventListener('click', function() {
    updateLapar(10);
});

document.getElementById('minumButton1').addEventListener('click', function() {
    updateLapar(5);
});

document.getElementById('minumButton2').addEventListener('click', function() {
    updateLapar(5);
});

document.getElementById('minumButton3').addEventListener('click', function() {
    updateLapar(5);
});

    function updateLapar(amount) {
        let currentLapar = localStorage.getItem('lapar') || 100; 
        currentLapar = parseInt(currentLapar);
    
        if (currentLapar < 100) {
            currentLapar += amount;
            if (currentLapar > 100) {
                currentLapar = 100; 
                alert("Bar lapar sudah penuh!");
            }
            localStorage.setItem('lapar', currentLapar);
        } 
    
        updateBarsDisplay(currentLapar, localStorage.getItem('sehat') || 100, localStorage.getItem('energi') || 100, localStorage.getItem('senang') || 100);
    }