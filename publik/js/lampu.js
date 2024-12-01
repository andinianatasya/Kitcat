const lampu = document.getElementById('lampu');
const overlay = document.getElementById('matiLampu');
const catImage = document.getElementById('catImage');

lampu.addEventListener('click', () => {
    const energiButton = document.getElementById('lampu');
    
    if (energiButton.disabled) {
        console.log('Tombol lampu dinonaktifkan, tidak ada perubahan yang dilakukan.');
        return;
    }

    isOverlayActive = !isOverlayActive;
    if (isOverlayActive) {
        overlay.classList.remove('hidden');
        catImage.src = 'img/tidur_bayi.png';
    } else {
        overlay.classList.add('hidden');
        catImage.src = 'img/default_bayi.png';
    }
});