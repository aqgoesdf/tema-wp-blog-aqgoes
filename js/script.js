/**
 * TechPulse — main.js
 *
 * ORGANIZAÇÃO DO ARQUIVO:
 * 1. Utilitários gerais
 * 2. Navegação (mobile menu + scroll)
 * 3. Formulário de contato (validação completa)
 * 4. Newsletter
 * 5. Filtro de artigos (artigos.html)
 * 6. Animações de entrada (Intersection Observer)
 * 7. Init — executa tudo quando o DOM estiver pronto
 */

'use strict';

/* ============================================================
   1. UTILITÁRIOS
   ============================================================ */

/**
 * Seleciona um elemento ou retorna null sem lançar erro.
 * Boa prática: evita crash quando uma função roda em página errada.
 */
const $ = (selector, parent = document) => parent.querySelector(selector);
const $$ = (selector, parent = document) => [...parent.querySelectorAll(selector)];

/** Debounce: aguarda um tempo antes de executar (útil para busca) */
function debounce(fn, delay = 300) {
  let timer;
  return (...args) => {
    clearTimeout(timer);
    timer = setTimeout(() => fn(...args), delay);
  };
}

/* ============================================================
   2. NAVEGAÇÃO
   ============================================================ */

function initNav() {
  const header  = $('#header');
  const toggle  = $('#navToggle');
  const menu    = $('#navMenu');

  if (!header || !toggle || !menu) return;

  /* ---- Mobile menu toggle ---- */
  toggle.addEventListener('click', () => {
    const isOpen = menu.classList.toggle('open');
    toggle.classList.toggle('open', isOpen);
    toggle.setAttribute('aria-expanded', isOpen);
  });

  /* ---- Fechar menu ao clicar em link ---- */
  $$('.nav__link', menu).forEach(link => {
    link.addEventListener('click', () => {
      menu.classList.remove('open');
      toggle.classList.remove('open');
      toggle.setAttribute('aria-expanded', 'false');
    });
  });

  /* ---- Header com fundo ao fazer scroll ---- */
  const onScroll = () => {
    header.classList.toggle('scrolled', window.scrollY > 50);
  };
  window.addEventListener('scroll', onScroll, { passive: true });
}

/* ============================================================
   3. FORMULÁRIO DE CONTATO
   ============================================================ */

/**
 * CONCEITO DE VALIDAÇÃO:
 * Usamos "validação no envio + feedback em tempo real após primeiro erro".
 * Isso evita mostrar erros enquanto o usuário ainda está digitando,
 * mas fornece feedback imediato depois que ele sai do campo com erro.
 */

function initContactForm() {
  const form       = $('#contactForm');
  if (!form) return;

  const submitBtn  = $('#submitBtn');
  const formSuccess = $('#formSuccess');
  const newMsgBtn  = $('#newMessageBtn');

  /* --- Regras de validação por campo --- */
  const rules = {
    nome: {
      validate: (v) => {
        if (!v.trim()) return 'O nome é obrigatório.';
        if (v.trim().length < 2) return 'O nome deve ter ao menos 2 caracteres.';
        return null;
      }
    },
    email: {
      validate: (v) => {
        if (!v.trim()) return 'O e-mail é obrigatório.';
        // Regex simples mas funcional para e-mails
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(v)) return 'Insira um e-mail válido.';
        return null;
      }
    },
    assunto: {
      validate: (v) => {
        if (!v) return 'Selecione um assunto.';
        return null;
      }
    },
    mensagem: {
      validate: (v) => {
        if (!v.trim()) return 'A mensagem é obrigatória.';
        if (v.trim().length < 20) return `Mensagem muito curta. Mínimo 20 caracteres (${v.trim().length}/20).`;
        return null;
      }
    }
  };

  /** Valida um campo e atualiza a UI com classe de erro/sucesso */
  function validateField(fieldId) {
    const input   = $(`#${fieldId}`, form);
    const group   = $(`#group${fieldId.charAt(0).toUpperCase() + fieldId.slice(1)}`, form);
    const errorEl = $(`#${fieldId}Error`, form);
    const rule    = rules[fieldId];

    if (!input || !group || !errorEl || !rule) return true;

    const error = rule.validate(input.value);

    if (error) {
      group.classList.add('error');
      group.classList.remove('success');
      errorEl.textContent = error;
      input.setAttribute('aria-invalid', 'true');
      return false;
    } else {
      group.classList.remove('error');
      group.classList.add('success');
      errorEl.textContent = '';
      input.setAttribute('aria-invalid', 'false');
      return true;
    }
  }

  /** Valida todos os campos e retorna true se todos passaram */
  function validateAll() {
    return Object.keys(rules)
      .map(id => validateField(id))
      .every(Boolean); // every(Boolean) = todos devem ser true
  }

  /* --- Contador de caracteres do textarea --- */
  const mensagemEl  = $('#mensagem', form);
  const charCount   = $('#mensagemCount', form);

  if (mensagemEl && charCount) {
    mensagemEl.addEventListener('input', () => {
      const len = mensagemEl.value.length;
      charCount.textContent = `${len} / 500 caracteres`;

      // Limite visual
      if (len > 500) {
        mensagemEl.value = mensagemEl.value.slice(0, 500);
        charCount.style.color = '#ff6584';
      } else {
        charCount.style.color = '';
      }
    });
  }

  /* --- Validação em tempo real (apenas após primeira submissão ou blur) --- */
  let hasSubmitted = false;

  Object.keys(rules).forEach(id => {
    const input = $(`#${id}`, form);
    if (!input) return;

    // Valida quando sair do campo (blur)
    input.addEventListener('blur', () => {
      if (hasSubmitted) validateField(id);
    });

    // Valida enquanto digita SE já houve tentativa de envio
    input.addEventListener('input', () => {
      if (hasSubmitted) validateField(id);
    });
  });

  /* --- Envio do formulário --- */
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    hasSubmitted = true;

    // Verifica honeypot (anti-spam)
    const honeypot = $('#website', form);
    if (honeypot && honeypot.value) {
      console.log('Spam detectado!');
      return;
    }

    // Valida todos os campos
    if (!validateAll()) {
      // Foca o primeiro campo com erro para acessibilidade
      const firstError = $('.form__group.error .form__input', form);
      if (firstError) firstError.focus();
      return;
    }

    // Loading state
    setSubmitLoading(true);

    try {
      // Simula requisição ao servidor (substitua por fetch real)
      await simulateRequest(1500);

      // Sucesso: esconde form, mostra mensagem
      form.classList.add('hidden');
      formSuccess.classList.remove('hidden');

    } catch (error) {
      console.error('Erro ao enviar:', error);
      alert('Ocorreu um erro. Tente novamente.');
    } finally {
      setSubmitLoading(false);
    }
  });

  /* --- Botão "enviar outra mensagem" --- */
  if (newMsgBtn) {
    newMsgBtn.addEventListener('click', () => {
      form.reset();
      hasSubmitted = false;

      // Limpa todos os estados visuais
      $$('.form__group', form).forEach(g => {
        g.classList.remove('error', 'success');
      });
      $$('.form__error', form).forEach(e => { e.textContent = ''; });
      if (charCount) charCount.textContent = '0 / 500 caracteres';

      form.classList.remove('hidden');
      formSuccess.classList.add('hidden');
    });
  }

  /** Alterna estado de loading no botão de envio */
  function setSubmitLoading(loading) {
    if (!submitBtn) return;
    const text    = $('.btn__text', submitBtn);
    const spinner = $('.btn__loading', submitBtn);
    submitBtn.disabled = loading;

    if (text && spinner) {
      text.classList.toggle('hidden', loading);
      spinner.classList.toggle('hidden', !loading);
    }
  }

  /** Simula delay de rede — REMOVA em produção e use fetch() */
  function simulateRequest(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }
}

/* ============================================================
   4. NEWSLETTER
   ============================================================ */

function initNewsletter() {
  const form     = $('#newsletterForm');
  if (!form) return;

  const feedback = $('#newsletterFeedback');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const emailInput = $('#newsletterEmail', form);
    const email      = emailInput?.value.trim();

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showFeedback('⚠️ Insira um e-mail válido.', 'error');
      return;
    }

    const btn = $('button[type="submit"]', form);
    if (btn) { btn.disabled = true; btn.textContent = 'Aguarde...'; }

    // Simula cadastro
    await new Promise(r => setTimeout(r, 1000));

    showFeedback('✅ Inscrição realizada! Bem-vindo à newsletter.', 'success');
    emailInput.value = '';
    if (btn) { btn.disabled = false; btn.textContent = 'Inscrever'; }
  });

  function showFeedback(msg, type) {
    if (!feedback) return;
    feedback.textContent = msg;
    feedback.style.color = type === 'error' ? '#ff6584' : '#50fa7b';
  }
}

/* ============================================================
   5. FILTRO DE ARTIGOS
   ============================================================ */

function initArticleFilter() {
  const tabs         = $$('.filter__tab');
  const cards        = $$('.article__card');
  const searchInput  = $('#searchInput');
  const countEl      = $('#articlesCount');
  const emptyEl      = $('#articlesEmpty');
  const searchTermEl = $('#searchTerm');

  if (!tabs.length || !cards.length) return;

  let currentFilter = 'all';

  /** Filtra os cards com base na categoria e no texto buscado */
  function filterCards() {
    const query = searchInput?.value.toLowerCase().trim() ?? '';
    let visible = 0;

    cards.forEach(card => {
      const category = card.dataset.category ?? '';
      const text     = card.textContent.toLowerCase();

      const matchesFilter = currentFilter === 'all' || category === currentFilter;
      const matchesSearch = !query || text.includes(query);

      if (matchesFilter && matchesSearch) {
        card.style.display = '';
        // Pequena animação de entrada
        card.style.animation = 'none';
        card.offsetHeight; // reflow
        card.style.animation = 'fadeIn 0.3s ease';
        visible++;
      } else {
        card.style.display = 'none';
      }
    });

    // Atualiza contador
    if (countEl) {
      countEl.innerHTML = `Mostrando <strong>${visible}</strong> artigo${visible !== 1 ? 's' : ''}`;
    }

    // Mostra/oculta mensagem de vazio
    if (emptyEl) {
      if (visible === 0) {
        emptyEl.classList.remove('hidden');
        if (searchTermEl) searchTermEl.textContent = query;
      } else {
        emptyEl.classList.add('hidden');
      }
    }
  }

  /* --- Tabs de filtro --- */
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => {
        t.classList.remove('active');
        t.setAttribute('aria-selected', 'false');
      });
      tab.classList.add('active');
      tab.setAttribute('aria-selected', 'true');
      currentFilter = tab.dataset.filter;
      filterCards();
    });
  });

  /* --- Busca com debounce (não dispara a cada tecla) --- */
  if (searchInput) {
    searchInput.addEventListener('input', debounce(filterCards, 250));
  }

  /* --- Filtro por URL param (?cat=css) --- */
  const params = new URLSearchParams(window.location.search);
  const catParam = params.get('cat');
  if (catParam) {
    const tab = tabs.find(t => t.dataset.filter === catParam);
    if (tab) tab.click();
  }
}

/* ============================================================
   6. INTERSECTION OBSERVER (animações de entrada)
   ============================================================ */

/**
 * CONCEITO: O IntersectionObserver executa código quando um elemento
 * entra no viewport (área visível da tela). Aqui usamos para animar
 * cards e seções conforme o usuário rola a página.
 */

function initScrollAnimations() {
  const style = document.createElement('style');
  style.textContent = `
    .anim-ready {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .anim-ready.visible {
      opacity: 1;
      transform: translateY(0);
    }
  `;
  document.head.appendChild(style);

  const targets = $$(
    '.news__card, .category__card, .article__card, .team__card, .stat__card, .tech__item'
  );

  targets.forEach((el, i) => {
    el.classList.add('anim-ready');
    el.style.transitionDelay = `${(i % 4) * 80}ms`; // stagger por coluna
  });

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target); // anima apenas uma vez
        }
      });
    },
    { threshold: 0.1, rootMargin: '0px 0px -40px 0px' }
  );

  targets.forEach(el => observer.observe(el));
}

/* ============================================================
   7. INIT
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {
  initNav();
  initContactForm();
  initNewsletter();
  initArticleFilter();
  initScrollAnimations();

  console.log(
    '%cTechPulse 🚀\n%cSite carregado com sucesso!',
    'color: #6c63ff; font-size: 18px; font-weight: bold;',
    'color: #888; font-size: 12px;'
  );
});
