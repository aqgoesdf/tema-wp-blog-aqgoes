/* ==========================================================================
   AQGOES THEME - SCRIPT UNIFICADO E OTIMIZADO
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    /* ── 1. DARK MODE (RESTAURADO AO MODELO ORIGINAL) ── */
    const htmlElement = document.documentElement;
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    function applyTheme(isDark) {
        if (isDark) {
            htmlElement.classList.add('dark');
            htmlElement.classList.remove('light');
        } else {
            htmlElement.classList.remove('dark');
            htmlElement.classList.add('light');
        }
        if (darkIcon) darkIcon.classList.toggle('hidden', isDark);
        if (lightIcon) lightIcon.classList.toggle('hidden', !isDark);
    }

    // Carrega a preferência salva ou do sistema
    const savedTheme = localStorage.getItem('color-theme') || localStorage.getItem('theme');
    const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialDark = savedTheme ? savedTheme === 'dark' : systemDark;
    
    applyTheme(initialDark);

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const isDark = !htmlElement.classList.contains('dark');
            applyTheme(isDark);
            localStorage.setItem('color-theme', isDark ? 'dark' : 'light');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    }

    /* ── 2. MENU HAMBÚRGUER RESPONSIVO ── */
    const menuToggleBtn = document.getElementById('menu-toggle') || document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu') || document.getElementById('menu');

    if (menuToggleBtn && mobileMenu) {
        menuToggleBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    /* ── 3. 📌 NAVEGUE POR TÓPICOS (H2, H3 E H4) ── */
    const postContent = document.getElementById('post-content');
    const tocTargets = document.querySelectorAll('.table-of-contents-target, #table-of-contents');

    if (postContent && tocTargets.length > 0) {
        const headings = postContent.querySelectorAll('h2, h3, h4');

        if (headings.length > 0) {
            tocTargets.forEach(target => target.innerHTML = '');

            headings.forEach((heading, index) => {
                if (!heading.id) {
                    const slug = heading.innerText
                        .toLowerCase()
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '')
                        .replace(/[^a-z0-9 -]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');

                    heading.id = slug || `topico-${index}`;
                }

                heading.classList.add('scroll-mt-28');

                tocTargets.forEach(target => {
                    const link = document.createElement('a');
                    link.href = '#' + heading.id;
                    link.className = 'hover:text-brand transition-colors text-xs font-semibold py-1.5 flex items-center gap-2 border-b border-subtle/30 sm:border-0';

                    const tagLower = heading.tagName.toLowerCase();
                    if (tagLower === 'h3') {
                        link.classList.add('pl-3', 'opacity-85');
                    } else if (tagLower === 'h4') {
                        link.classList.add('pl-6', 'opacity-70');
                    }

                    link.innerHTML = `<span class="text-brand text-[10px] flex-shrink-0">►</span> <span class="truncate">${heading.innerText}</span>`;

                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const targetId = this.getAttribute('href').substring(1);
                        const targetElement = document.getElementById(targetId);

                        if (targetElement) {
                            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            history.pushState(null, null, '#' + targetId);
                        }
                    });

                    target.appendChild(link);
                });
            });
        } else {
            const mobileToc = document.getElementById('toc-container-mobile');
            const desktopToc = document.getElementById('toc-container-desktop');
            if (mobileToc) mobileToc.style.display = 'none';
            if (desktopToc) desktopToc.style.display = 'none';
        }
    }
});