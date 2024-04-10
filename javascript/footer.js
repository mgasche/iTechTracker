// JavaScript, um den Footer am unteren Rand zu positionieren
window.addEventListener('DOMContentLoaded', (event) => {
    const contentHeight = document.querySelector('.content').offsetHeight;
    const windowHeight = window.innerHeight;

    if (contentHeight < windowHeight) {
        document.querySelector('.footer').classList.add('fixed-bottom');
    }
});
