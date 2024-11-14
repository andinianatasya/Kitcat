document.addEventListener('DOMContentLoaded', function() {
const dropdownButton = document.getElementById("dropdownButton");
const dropdownMenu = document.getElementById("lokasidropdown");
const dropdownItems = dropdownMenu.querySelectorAll('li');

dropdownButton.addEventListener("click", (event) => {
event.stopPropagation(); 
dropdownMenu.classList.toggle("hidden"); 

dropdownItems.forEach((item, index) => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(1rem)';
    item.style.transitionDelay = `${index * 100}ms`;
});

dropdownMenu.offsetHeight;
dropdownItems.forEach((item) => {
    item.style.opacity = '1';
    item.style.transform = 'translateY(0)';
});
});

document.querySelectorAll("#lokasidropdown a").forEach(link => {
link.addEventListener("click", () => {
    dropdownMenu.classList.add("hidden");
});
});

window.addEventListener('click', () => {
if (!dropdownMenu.classList.contains('hidden')) {
    dropdownMenu.classList.add('hidden');
}});
});


///////////Ruang mainn
const questionImage = document.getElementById("questionImage");
const quizOverlay = document.getElementById("quizOverlay");

questionImage.addEventListener("click", () => {
    quizOverlay.classList.remove("hidden");
});
    
function showAnswer(questionNumber) {
const answerDiv = document.getElementById(`correctAnswer${questionNumber}`);
answerDiv.style.display = answerDiv.style.display === "none" ? "block" : "none";
} 