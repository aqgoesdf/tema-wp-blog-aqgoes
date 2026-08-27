/* ==========================================================================
   AQGOES THEME - SCRIPT UNIFICADO E OTIMIZADO
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    /* ── 1. DARK MODE ── */
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

    /* ── 3. CARROSSEL DA PÁGINA DE POSTS (TEMPLATE/ARCHIVE) ── */
    const track = document.getElementById('carousel-track');
    const prevBtn = document.getElementById('carousel-prev');
    const nextBtn = document.getElementById('carousel-next');
    const dotsContainer = document.getElementById('carousel-dots');

    if (track) {
        const slides = Array.from(track.children);
        const dots = dotsContainer ? Array.from(dotsContainer.children) : [];
        let currentIndex = 0;

        const updateCarousel = (index) => {
            if (slides.length === 0) return;
            
            // Garante rotação em ciclo infinito
            if (index < 0) {
                currentIndex = slides.length - 1;
            } else if (index >= slides.length) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }

            // Move o trilho de acordo com o slide atual
            track.style.transform = `translateX(-${currentIndex * 100}%)`;

            // Atualiza os pontos de navegação (dots)
            dots.forEach((dot, i) => {
                if (i === currentIndex) {
                    dot.classList.add('bg-brand', 'w-6');
                    dot.classList.remove('bg-subtle', 'w-2');
                } else {
                    dot.classList.remove('bg-brand', 'w-6');
                    dot.classList.add('bg-subtle', 'w-2');
                }
            });
        };

        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                updateCarousel(currentIndex + 1);
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                updateCarousel(currentIndex - 1);
            });
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                updateCarousel(index);
            });
        });

        // Inicializa o carrossel no primeiro item
        updateCarousel(0);
    }

    /* ── 4. 📌 NAVEGUE POR TÓPICOS COM SCROLL OFFSET ── */
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
                            let offset = 110;

                            if (window.innerWidth < 1024) {
                                const mobileToc = document.getElementById('toc-container-mobile');
                                const header = document.querySelector('header');
                                const headerHeight = header ? header.offsetHeight : 80;
                                const tocHeight = mobileToc ? mobileToc.offsetHeight : 180;
                                offset = headerHeight + tocHeight + 20;
                            }

                            const elementPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                            const offsetPosition = elementPosition - offset;

                            window.scrollTo({
                                top: offsetPosition,
                                behavior: 'smooth'
                            });

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

    /* ── 5. BARRA DE PROGRESSO E VOLTAR AO TOPO ── */
    const progressBar = document.getElementById('reading-progress-bar');
    const backToTopBtn = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
        const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        
        if (progressBar && height > 0) {
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + '%';
        }

        if (backToTopBtn) {
            if (winScroll > 400) {
                backToTopBtn.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                backToTopBtn.classList.add('opacity-100', 'translate-y-0');
            } else {
                backToTopBtn.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                backToTopBtn.classList.remove('opacity-100', 'translate-y-0');
            }
        }
    });

    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});