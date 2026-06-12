
/*
    Template Name: Página Artigos AqGoEs
*/
<?php get_header(); ?>
  <main>

    <!-- PAGE HERO -->
    <section class="page-hero">
      <div class="container">
        <span class="hero__tag">📚 Biblioteca de conteúdo</span>
        <h1>Todos os <em>Artigos</em></h1>
        <p>69 artigos técnicos sobre HTML, CSS, JavaScript e Python.</p>
      </div>
    </section>

    <!-- FILTROS + BUSCA -->
    <section class="articles-controls section-pad">
      <div class="container">
        <div class="controls__bar">
          <!-- Busca -->
          <div class="search__wrapper">
            <label for="searchInput" class="sr-only">Buscar artigos</label>
            <input
              type="search"
              id="searchInput"
              placeholder="🔍 Buscar artigos..."
              class="search__input"
            />
          </div>

          <!-- Filtros por categoria -->
          <div class="filter__tabs" role="tablist" aria-label="Filtrar por categoria">
            <button class="filter__tab active" data-filter="all" role="tab" aria-selected="true">Todos</button>
            <button class="filter__tab" data-filter="html" role="tab" aria-selected="false">HTML</button>
            <button class="filter__tab" data-filter="css" role="tab" aria-selected="false">CSS</button>
            <button class="filter__tab" data-filter="javascript" role="tab" aria-selected="false">JavaScript</button>
            <button class="filter__tab" data-filter="python" role="tab" aria-selected="false">Python</button>
          </div>
        </div>
      </div>
    </section>

    <!-- LISTA DE ARTIGOS -->
    <section class="articles-list section-pad">
      <div class="container">
        <p class="articles__count" id="articlesCount">Mostrando <strong>8</strong> artigos</p>

        <div class="articles__grid" id="articlesGrid">

          <!-- Artigos HTML -->
          <article class="article__card" data-category="html">
            <div class="article__thumb article__thumb--html">
              <span>🌐</span>
            </div>
            <div class="article__body">
              <span class="news__category">HTML</span>
              <h3><a href="#">Semântica HTML5: o guia definitivo</a></h3>
              <p>Aprenda a usar as tags certas para melhorar SEO e acessibilidade de qualquer projeto.</p>
              <div class="article__meta">
                <span>👤 Ana Dev</span>
                <span>📅 Fev 2025</span>
                <span>⏱ 8 min</span>
              </div>
            </div>
          </article>

          <article class="article__card" data-category="html">
            <div class="article__thumb article__thumb--html"><span>🌐</span></div>
            <div class="article__body">
              <span class="news__category">HTML</span>
              <h3><a href="#">Web Components do zero: criando elementos customizados</a></h3>
              <p>Custom Elements, Shadow DOM e HTML Templates na prática.</p>
              <div class="article__meta">
                <span>👤 Diego Full</span>
                <span>📅 Jan 2025</span>
                <span>⏱ 12 min</span>
              </div>
            </div>
          </article>

          <!-- Artigos CSS -->
          <article class="article__card" data-category="css">
            <div class="article__thumb article__thumb--css"><span>🎨</span></div>
            <div class="article__body">
              <span class="news__category">CSS</span>
              <h3><a href="#">CSS Grid: layouts complexos de forma simples</a></h3>
              <p>Do básico ao avançado: subgrid, named areas e técnicas para 2025.</p>
              <div class="article__meta">
                <span>👤 Carlos UI</span>
                <span>📅 Jan 2025</span>
                <span>⏱ 10 min</span>
              </div>
            </div>
          </article>

          <article class="article__card" data-category="css">
            <div class="article__thumb article__thumb--css"><span>🎨</span></div>
            <div class="article__body">
              <span class="news__category">CSS</span>
              <h3><a href="#">Container Queries: o fim dos breakpoints globais</a></h3>
              <p>Como criar componentes verdadeiramente responsivos com @container.</p>
              <div class="article__meta">
                <span>👤 Ana Dev</span>
                <span>📅 Dez 2024</span>
                <span>⏱ 7 min</span>
              </div>
            </div>
          </article>

          <!-- Artigos JS -->
          <article class="article__card" data-category="javascript">
            <div class="article__thumb article__thumb--js"><span>⚡</span></div>
            <div class="article__body">
              <span class="news__category">JavaScript</span>
              <h3><a href="#">ECMAScript 2025: tudo que é novo</a></h3>
              <p>Decorators, novos métodos de Array, melhorias em Promise e muito mais.</p>
              <div class="article__meta">
                <span>👤 Bia Full</span>
                <span>📅 Fev 2025</span>
                <span>⏱ 15 min</span>
              </div>
            </div>
          </article>

          <article class="article__card" data-category="javascript">
            <div class="article__thumb article__thumb--js"><span>⚡</span></div>
            <div class="article__body">
              <span class="news__category">JavaScript</span>
              <h3><a href="#">Fetch API na prática: requisições, erros e loading states</a></h3>
              <p>Como consumir APIs REST de forma profissional sem bibliotecas externas.</p>
              <div class="article__meta">
                <span>👤 Diego Full</span>
                <span>📅 Jan 2025</span>
                <span>⏱ 9 min</span>
              </div>
            </div>
          </article>

          <!-- Artigos Python -->
          <article class="article__card" data-category="python">
            <div class="article__thumb article__thumb--python"><span>🐍</span></div>
            <div class="article__body">
              <span class="news__category">Python</span>
              <h3><a href="#">FastAPI: criando uma API REST em menos de 30 minutos</a></h3>
              <p>Rotas, validação com Pydantic, documentação automática e deploy.</p>
              <div class="article__meta">
                <span>👤 Carlos Backend</span>
                <span>📅 Fev 2025</span>
                <span>⏱ 18 min</span>
              </div>
            </div>
          </article>

          <article class="article__card" data-category="python">
            <div class="article__thumb article__thumb--python"><span>🐍</span></div>
            <div class="article__body">
              <span class="news__category">Python</span>
              <h3><a href="#">Web Scraping com BeautifulSoup: extração de dados para iniciantes</a></h3>
              <p>Colete dados de qualquer site de forma ética e eficiente.</p>
              <div class="article__meta">
                <span>👤 Bia Backend</span>
                <span>📅 Dez 2024</span>
                <span>⏱ 11 min</span>
              </div>
            </div>
          </article>

        </div>

        <!-- Mensagem sem resultados (oculto por padrão) -->
        <div class="articles__empty hidden" id="articlesEmpty">
          <p>😕 Nenhum artigo encontrado para "<strong id="searchTerm"></strong>"</p>
        </div>

        <!-- Paginação -->
        <nav class="pagination" aria-label="Paginação">
          <button class="pagination__btn" disabled>← Anterior</button>
          <span class="pagination__info">Página 1 de 9</span>
          <button class="pagination__btn">Próxima →</button>
        </nav>
      </div>
    </section>

  </main>
<?php get_footer(); ?>