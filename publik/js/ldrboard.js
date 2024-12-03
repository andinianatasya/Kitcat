// Mengambil elemen dari DOM
const leaderboardButton = document.getElementById('leaderboardButton');
const leaderboardSection = document.getElementById('leaderboardSection');
const programmingCategory = document.getElementById('programmingCategory');
const markupCategory = document.getElementById('markupCategory');
const papanPemrograman = document.getElementById('papanPemrograman');
const papanMarkup = document.getElementById('papanMarkup');
const closeButton = document.getElementById('closeButton');

// Fungsi untuk menampilkan leaderboardSection
leaderboardButton.addEventListener('click', () => {
    leaderboardSection.classList.remove('hidden');
    papanPemrograman.classList.add('hidden');
    papanMarkup.classList.add('hidden');
    console.log('leaderboardbutton');
    programmingCategory.classList.remove('hidden');
    markupCategory.classList.remove('hidden');
});

// Fungsi untuk menutup leaderboardSection
closeButton.addEventListener('click', () => {
    leaderboardSection.classList.add('hidden');
});

// Fungsi untuk menampilkan papanPemrograman dan menutup leaderboardSection
programmingCategory.addEventListener('click', () => {
    console.log('programmingcategory');
    papanPemrograman.classList.remove('hidden');
    papanMarkup.classList.add('hidden');
    programmingCategory.classList.add('hidden');
    markupCategory.classList.add('hidden');
});

// Fungsi untuk menampilkan papanMarkup dan menutup leaderboardSection
markupCategory.addEventListener('click', () => {
    console.log('markupcategory');
    papanPemrograman.classList.add('hidden');
    papanMarkup.classList.remove('hidden');
    programmingCategory.classList.add('hidden');
    markupCategory.classList.add('hidden');
});
// Event listener untuk kategori pemrograman
document.getElementById('programmingCategory').addEventListener('click', function() {
    displayLeaderboard('programming');
});

// Event listener untuk kategori markup
document.getElementById('markupCategory').addEventListener('click', function() {
    displayLeaderboard('markup');
});

// Function to show the leaderboard
function showLeaderboard() {
    document.getElementById('leaderboardSection').classList.remove('hidden');
    document.getElementById('quizOverlay').classList.add('hidden'); // Hide quiz overlay if it's visible
}

// Function to hide the leaderboard
function hideLeaderboard() {
    document.getElementById('leaderboardSection').classList.add('hidden');
}

// Function to show the quiz
function showQuiz() {
    document.getElementById('quizOverlay').classList.remove('hidden');
    document.getElementById('leaderboardSection').classList.add('hidden'); // Hide leaderboard if it's visible
}

// Function to hide the quiz
function hideQuiz() {
    document.getElementById('quizOverlay').classList.add('hidden');
}