// --- LÓGICA DO DARK / LIGHT MODE ---
const themeToggles = document.querySelectorAll('.theme-toggle');
const htmlElement = document.documentElement;

function updateThemeUI(isLight) {
    themeToggles.forEach(btn => {
        const moon = btn.querySelector('.icon-moon');
        const sun = btn.querySelector('.icon-sun');
        if (isLight) {
            moon.classList.add('hidden');
            sun.classList.remove('hidden');
        } else {
            moon.classList.remove('hidden');
            sun.classList.add('hidden');
        }
    });
}

function toggleTheme() {
    const isLight = htmlElement.classList.toggle('light');
    if (isLight) {
        htmlElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        htmlElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
    updateThemeUI(isLight);
}

themeToggles.forEach(btn => btn.addEventListener('click', toggleTheme));

// Carrega o tema salvo do usuário
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'light') {
    htmlElement.classList.add('light');
    htmlElement.classList.remove('dark');
    updateThemeUI(true);
} else {
    htmlElement.classList.add('dark');
    updateThemeUI(false);
}
