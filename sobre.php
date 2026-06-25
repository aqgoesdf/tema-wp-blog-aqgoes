<?php
/**
 * Template Name: Página Sobre Blog AqGoEs
 */

get_header(); 
?>

  <main>

    <section class="page-hero">
      <div class="container">
        <span class="hero__tag">👋 Quem somos</span>
        <h1>Sobre <em><?php bloginfo('name'); ?></em></h1>
        <p>Uma plataforma de conteúdo técnico criada por devs, para devs.</p>
      </div>
    </section>

    <section class="about-mission section-pad">
      <div class="container about-mission__grid">
        <div class="about-mission__text">
          <h2>Nossa <span>Missão</span></h2>
          <p>
            O <strong>AqGoEs</strong> nasceu com o objetivo de ir além dos conteúdos rasos e tutoriais que param no "Hello World".
            Queremos ir fundo: explicar o porquê das coisas, mostrar as melhores práticas e preparar
            desenvolvedores para o mercado real.
          </p>
          <p>
            Cobrimos os quatro pilares do desenvolvimento web moderno: <strong>HTML</strong> semântico,
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

    <section class="about-team section-pad">
      <div class="container">
        <h2 class="section__title">A <span>Equipe</span></h2>
        <div class="team__grid">

          <article class="team__card">
            <div class="team__avatar team__avatar--1">AQ</div>
            <h3>Alan Queirós</h3>
            <span class="team__role">Fullstack Developer</span>
            <p>Idealizador do projeto, focado em criar arquiteturas de software limpas usando Next.js, Python e automações inteligentes.</p>
          </article>

          <article class="team__card">
            <div class="team__avatar team__avatar--2">AD</div>
            <h3>Ana Dev</h3>
            <span class="team__role">Front-end & UI Designer</span>
            <p>Especialista em criar layouts fluidos, design systems responsivos e estilizações avançadas em CSS moderno.</p>
          </article>

          <article class="team__card">
            <div class="team__avatar team__avatar--3">BF</div>
            <h3>Bia Full Stack</h3>
            <span class="team__role">JavaScript Specialist</span>
            <p>Focada em otimização de performance no client-side, manipulação avançada de DOM e integrações de APIs assíncronas.</p>
          </article>

        </div>
      </div>
    </section>

    <section class="about-cta section-pad">
      <div class="container">
        <div class="cta__box">
          <h2>Quer contribuir?</h2>
          <p>Estamos sempre abertos a novos autores e parcerias. Entre em contato!</p>
          <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>" class="btn btn--primary">Falar com a gente</a>
        </div>
      </div>
    </section>

  </main>

<?php get_footer(); ?>