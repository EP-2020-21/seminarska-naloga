const overlay = document.getElementById('mobile-menu-overlay');
const toggleMenu = (show) => {
        if (show && overlay.classList.contains('w-0')){
                overlay.classList.remove('w-8');
                overlay.classList.add('w-screen');
        } else {
                overlay.classList.remove('w-screen');
                overlay.classList.add('w-0')
        }
};