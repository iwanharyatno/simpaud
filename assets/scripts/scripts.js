const toggler = document.querySelector('.nav-toggler');
const mainMenu = document.getElementById('mainMenu');

toggler.addEventListener('click', function () {
    if (mainMenu.style.display === 'flex') {
        mainMenu.style.display = 'none';
    } else {
        mainMenu.style.display = 'flex';
    }
});

const el = document.querySelector(".navigation")
const observer = new IntersectionObserver(
    ([e]) => {
        console.log(e.intersectionRatio)
        return e.target.classList.toggle("is-pinned", e.intersectionRatio <= 0)
    },
    { threshold: [1] }
);

observer.observe(el);