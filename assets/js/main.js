document.addEventListener('DOMContentLoaded', () => {
    // --- LÓGICA DO MENU HAMBÚRGUER ---
    const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');
    const navLinks = document.querySelectorAll('.nav-link');

    if (menuBtn && menu) {
        function toggleMenu() {
            const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
            
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');
            
            if (iconOpen) iconOpen.classList.toggle('hidden');
            if (iconClose) iconClose.classList.toggle('hidden');
            
            menuBtn.setAttribute('aria-expanded', !isExpanded);
        }

        menuBtn.addEventListener('click', toggleMenu);

        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (!menu.classList.contains('hidden') && window.innerWidth < 768) {
                    toggleMenu();
                }
            });
        });
    }
});