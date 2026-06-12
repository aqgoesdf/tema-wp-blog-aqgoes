/*
    Template Name: Página Sobre Blog AqGoEs

*/

<?php get_header(); ?>

  <main>

    <!-- PAGE HERO -->
    <section class="page-hero">
      <div class="container">
        <span class="hero__tag">👋 Quem somos</span>
        <h1>Sobre <em><?php bloginfo('name'); ?></em></h1>
        <p>Uma plataforma de conteúdo técnico criada por devs, para devs.</p>
      </div>
    </section>

    <!-- MISSÃO -->
    <section class="about-mission section-pad">
      <div class="container about-mission__grid">
        <div class="about-mission__text">
          <h2>Nossa <span>Missão</span></h2>
          <p>
            O TechPulse nasceu da frustração com conteúdos rasos e tutoriais que param no "Hello World".
            Queremos ir fundo: explicar o porquê das coisas, mostrar as melhores práticas e preparar
            desenvolvedores para o mercado real.
          </p>
          <p>
            Cobrimos as quatro pilares do desenvolvimento web moderno: <strong>HTML</strong> semântico,
            <strong>CSS</strong> avançado, <strong>JavaScript</strong> moderno e <strong>Python</strong>
            para o back-end. Sem enrolação.
          </p>
        </div>
        <div class="about-mission__stats">
          <div class="stat__card">
            <strong>69+</strong>
            <span>Artigos publicados</span>
          </div>
          <div class="stat__card">
            <strong>4</strong>
            <span>Tecnologias cobertas</span>
          </div>
          <div class="stat__card">
            <strong>5k+</strong>
            <span>Leitores mensais</span>
          </div>
          <div class="stat__card">
            <strong>100%</strong>
            <span>Conteúdo gratuito</span>
          </div>
        </div>
      </div>
    </section>

    <!-- TECNOLOGIAS -->
    <section class="about-tech section-pad">
      <div class="container">
        <h2 class="section__title">O que <span>abordamos</span></h2>

        <div class="tech__list">

          <div class="tech__item">
            <div class="tech__icon">🌐</div>
            <div>
              <h3>HTML5</h3>
              <p>Semântica, acessibilidade (ARIA), Web Components, SEO técnico e as novidades do HTML Living Standard.</p>
            </div>
          </div>

          <div class="tech__item">
            <div class="tech__icon">🎨</div>
            <div>
              <h3>CSS Moderno</h3>
              <p>Flexbox, Grid, Container Queries, Custom Properties, animações performáticas e design systems.</p>
            </div>
          </div>

          <div class="tech__item">
            <div class="tech__icon">⚡</div>
            <div>
              <h3>JavaScript</h3>
              <p>ES2025, manipulação de DOM, Fetch API, Web Workers, performance e as melhores práticas do ecossistema.</p>
            </div>
          </div>

          <div class="tech__item">
            <div class="tech__icon">🐍</div>
            <div>
              <h3>Python Web</h3>
              <p>FastAPI, Django, Flask, web scraping com BeautifulSoup e automação para desenvolvedores web.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- EQUIPE -->
    <section class="about-team section-pad">
      <div class="container">
        <h2 class="section__title">A <span>Equipe</span></h2>
        <div class="team__grid">

          <article class="team__card">
            <div class="team__avatar team__avatar--1">AD</div>
            <h3>Ana Dev</h3>
            <span class="team__role">Front-end & CSS</span>
            <p>Especialista em design systems e CSS avançado. 8 anos de experiência em UIs complexas.</p>
          </article>

          <article class="team__card">
            <div class="team__avatar team__avatar--2">CB</div>
            <h3>Carlos Backend</h3>
            <span class="team__role">Python & APIs</span>
            <p>Desenvolvedor Python há 6 anos, apaixonado por FastAPI e arquiteturas escaláveis.</p>
          </article>

          <article class="team__card">
            <div class="team__avatar team__avatar--3">BF</div>
            <h3>Bia Full Stack</h3>
            <span class="team__role">JavaScript & Node</span>
            <p>Full stack com foco em performance web e JavaScript moderno. Contribuidora open source.</p>
          </article>

        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="about-cta section-pad">
      <div class="container">
        <div class="cta__box">
          <h2>Quer contribuir?</h2>
          <p>Estamos sempre abertos a novos autores e parcerias. Entre em contato!</p>
          <a href="contato.html" class="btn btn--primary">Falar com a gente</a>
        </div>
      </div>
    </section>

  </main>

  <?php get_footer(); ?>