document.getElementById('pemro').addEventListener('click', function() {
    updateSenang(10);
    });
    document.getElementById('html').addEventListener('click', function() {
    updateSenang(10);
    });
    function updateSenang(amount) {
        let currentSenang = localStorage.getItem('senang') || 100; 
        currentSenang = parseInt(currentSenang);
    
        if (currentSenang < 100) {
            currentSenang += amount;
            if (currentSenang > 100) {
                currentSenang = 100; 
                alert("Bar kesenangan terisi!");
            }
            localStorage.setItem('senang', currentSenang);
        } 
    
        updateBarsDisplay(currentSenang, localStorage.getItem('sehat') || 100, localStorage.getItem('lapar') || 100, localStorage.getItem('energi') || 100);
    }