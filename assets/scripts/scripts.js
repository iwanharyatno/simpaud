const toggler = document.querySelector('.nav-toggler');
const mainMenu = document.getElementById('mainMenu');

toggler.addEventListener('click', function() {
    if (mainMenu.style.display === 'flex') {
        mainMenu.style.display = 'none';
    } else {
        mainMenu.style.display = 'flex';
    }
});