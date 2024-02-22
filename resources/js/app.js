import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        let alert = document.querySelector('.animated');
        if (!alert) return;
        alert.classList.add('transition-opacity', 'duration-500', 'ease-in-out', 'opacity-0');
        setTimeout(function() {
            alert.remove();
        }, 500);
    }, 3000);
});