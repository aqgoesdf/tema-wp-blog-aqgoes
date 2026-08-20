document.addEventListener('DOMContentLoaded', function () {
	'use strict';

	/* ═══════════════════════════
	   1. DARK / LIGHT MODE
	   Chave única no localStorage: "theme"
	═══════════════════════════ */
	var themeToggleBtn = document.getElementById('theme-toggle');
	var darkIcon = document.getElementById('theme-toggle-dark-icon');
	var lightIcon = document.getElementById('theme-toggle-light-icon');

	function applyTheme(isDark) {
		document.documentElement.classList.toggle('dark', isDark);
		if (darkIcon) darkIcon.classList.toggle('hidden', isDark);
		if (lightIcon) lightIcon.classList.toggle('hidden', !isDark);
	}

	if (themeToggleBtn) {
		var savedTheme = localStorage.getItem('theme');
		var isDark = savedTheme
			? savedTheme === 'dark'
			: window.matchMedia('(prefers-color-scheme: dark)').matches;

		applyTheme(isDark);

		themeToggleBtn.addEventListener('click', function () {
			var newIsDark = !document.documentElement.classList.contains('dark');
			applyTheme(newIsDark);
			localStorage.setItem('theme', newIsDark ? 'dark' : 'light');
		});
	}

	/* ═══════════════════════════
	   2. MENU MOBILE
	═══════════════════════════ */
	var menuToggleBtn = document.getElementById('menu-toggle');
	var mobileMenu = document.getElementById('mobile-menu');

	if (menuToggleBtn && mobileMenu) {
		menuToggleBtn.addEventListener('click', function () {
			mobileMenu.classList.toggle('hidden');
		});

		mobileMenu.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				mobileMenu.classList.add('hidden');
			});
		});
	}

	/* ═══════════════════════════
	   3. CARROSSEL (template-artigos.php)
	═══════════════════════════ */
	var track = document.getElementById('carousel-track');
	var prevBtn = document.getElementById('carousel-prev');
	var nextBtn = document.getElementById('carousel-next');
	var dotsContainer = document.getElementById('carousel-dots');

	if (track) {
		var slides = Array.prototype.slice.call(track.children);
		var dots = dotsContainer ? Array.prototype.slice.call(dotsContainer.children) : [];
		var currentIndex = 0;

		function updateCarousel(index) {
			currentIndex = index;
			track.style.transform = 'translateX(-' + (index * 100) + '%)';
			dots.forEach(function (dot, i) {
				dot.classList.toggle('bg-brand', i === index);
				dot.classList.toggle('bg-subtle', i !== index);
			});
		}

		if (nextBtn) {
			nextBtn.addEventListener('click', function () {
				updateCarousel((currentIndex + 1) % slides.length);
			});
		}
		if (prevBtn) {
			prevBtn.addEventListener('click', function () {
				updateCarousel((currentIndex - 1 + slides.length) % slides.length);
			});
		}
		dots.forEach(function (dot, index) {
			dot.addEventListener('click', function () { updateCarousel(index); });
		});
	}

	/* ═══════════════════════════
	   4. COPIAR CÓDIGO (blocos de código nos posts)
	═══════════════════════════ */
	document.querySelectorAll('.copy-code-btn').forEach(function (button) {
		button.addEventListener('click', function () {
			var group = button.closest('.group');
			var codeBlock = group ? group.querySelector('code') : null;
			if (!codeBlock) return;

			navigator.clipboard.writeText(codeBlock.innerText).then(function () {
				var span = button.querySelector('span');
				var originalText = span ? span.textContent : '';
				if (span) span.textContent = 'Copiado!';
				button.classList.add('bg-emerald-600', 'text-white');

				setTimeout(function () {
					if (span) span.textContent = originalText;
					button.classList.remove('bg-emerald-600', 'text-white');
				}, 2000);
			}).catch(function (err) {
				console.error('Erro ao copiar código:', err);
			});
		});
	});

	/* ═══════════════════════════
	   5. SUMÁRIO (TOC) do post
	═══════════════════════════ */
	var postContent = document.getElementById('post-content');
	var tocNav = document.getElementById('table-of-contents');
	var tocContainer = document.getElementById('toc-container');

	if (postContent && tocNav) {
		var headings = postContent.querySelectorAll('h2, h3');

		if (headings.length > 0) {
			tocNav.innerHTML = '';

			headings.forEach(function (heading, index) {
				if (!heading.id) {
					var slug = heading.innerText
						.toLowerCase()
						.normalize('NFD')
						.replace(/[\u0300-\u036f]/g, '')
						.replace(/[^a-z0-9 -]/g, '')
						.replace(/\s+/g, '-')
						.replace(/-+/g, '-');
					heading.id = slug || 'topico-' + index;
				}

				heading.classList.add('scroll-mt-28');

				var link = document.createElement('a');
				link.href = '#' + heading.id;
				link.className = 'hover:text-brand transition-colors text-xs font-semibold py-1.5 flex items-center gap-2 border-b border-subtle/30 sm:border-0';
				if (heading.tagName.toLowerCase() === 'h3') {
					link.classList.add('pl-4', 'opacity-80');
				}
				link.innerHTML = '<span class="text-brand text-[10px] flex-shrink-0">►</span> <span class="truncate">' + heading.innerText + '</span>';

				link.addEventListener('click', function (e) {
					e.preventDefault();
					var targetId = this.getAttribute('href').substring(1);
					var targetEl = document.getElementById(targetId);
					if (targetEl) {
						targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
						history.pushState(null, null, '#' + targetId);
					}
				});

				tocNav.appendChild(link);
			});
		} else if (tocContainer) {
			tocContainer.style.display = 'none';
		}
	}
});
