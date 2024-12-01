const lampu = document.getElementById('lampu');
const overlay = document.getElementById('matiLampu');
let isOverlayActive = false;
    
lampu.addEventListener('click', () => {
    isOverlayActive = !isOverlayActive;
    if (isOverlayActive) {
        overlay.classList.remove('hidden');

            catImage.src = 'img/tidur_bayi.png';
        } else 
            overlay.classList.add('hidden');
            catImage.src = 'img/default_bayi.png';
            
});